<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Common\Task;

class StartSocketServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    
    public $ip = '127.0.0.1';

    public $porta = '8889';

    protected $signature = 'socket:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
  
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(){
            $user = [];
            $websocket = new \Hoa\Websocket\Server(
                new \Hoa\Socket\Server(env('TCP_URL'))
            );
            $websocket->on('open', function (\Hoa\Core\Event\Bucket $bucket)  {
                     return;
            });
            $websocket->on('message', function ( \Hoa\Core\Event\Bucket $bucket) use (&$websocket) {
                $data = $bucket->getData();

                $x = json_decode($data['message']);

                if(isset($x->Test)){
                    Task::updateTaskStatus($x->task_id);
                    return true;
                }                
                if(isset($x->onopen)){
                    $this->user[$x->id] = [
                       "ClientId" => $this->getClientId($bucket)
                    ];
                    return true;
                }
                 if(isset($x->send) && isset($this->user[$x->id]) ){
                     $nodes = $bucket->getSource()->getConnection()->getNodes();
                     foreach($nodes as $node) {
                         if($node->getID() === $this->user[$x->id]['ClientId']) {
                                $task = Task::find($x->task_id)->toArray();
                                $data_ = [
                                    'type' => 'new',
                                    'task' => $task,
                                ];
                              $websocket->send(json_encode($data_,true),  $node);
                            }
                     }
                    return true;
                 }
                 
            });    
            $websocket->on('close', function (\Hoa\Core\Event\Bucket $bucket) {
                    return true;
            });
            $websocket->run();
    }
   public function getClientId($bucket) {
        return $bucket->getSource()->getConnection()->getCurrentNode()->getId();
    }
}
