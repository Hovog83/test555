<?php
namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Common\Task;
use App\Models\Common\User;
use App\Models\Common\UserTask;
use Illuminate\Http\Request;
use Validator;
use Yajra\Datatables\Datatables;


class TaskController extends Controller{
    public function index(){
        return view('back.task.index');
    }
    public function addEdit(Request $request, $id = false) {

        $users = User::where([
                'status'=> "ACTIVE",
                // 'role'=> User::ROLE_USER,
            ])->select('id', 'email')->lists('email','id')->toArray();        
    	if(!$id){
	    	$task = new Task();
            $url = 'admin/task/create';
    	}else{
    		$task = Task::find($id);
            $url = 'admin/task/edit/'.$id;
    	}
        // $usersC = $task->getUserTask()->first()->getUser()->lists('email','id')->toArray();
        if ($request->isMethod('post')) {
          $validator = Validator::make($request->all(),Task::rules());
	        if ($validator->fails()) {
	            return redirect($url)
	                       ->withErrors($validator,'addEdit')
	                       ->withInput();
	        }else{
                 $task->title       = $request->title;
                 $task->status      = $request->status;
                 $task->start_date  = $request->start_date; 
                 $task->end_date    = $request->end_date;
                 $task->description = $request->description;
         	  	 $task->save();
                $client   = new \Hoa\Websocket\Client(
                new \Hoa\Socket\Client(env('TCP_URL'))
                );
                $client->connect();
                UserTask::where('task_id', $task->id)->delete();
                foreach ($request->user_id as $key => $value) {
                    $dataUser = array(
                        'user_id' => $value,
                        'task_id' => $task->id,
                    );
                    $ws = '"send":true,"id": '.$value.',"task_id": '.$task->id.'';
                    $client->send('{'.$ws.'}');    
                    $insertDataUser[] = $dataUser;
                 }
                 UserTask::insert($insertDataUser);
	        }
	        return redirect('admin/task');
        }
        return view('back.task.addEdit',["task"=>$task,"users"=>$users]);
    }
    public function delete($id) {
        UserTask::where('task_id', $id)->delete();
        Task::find($id)->delete();
         return redirect('admin/task');
    }
    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData(){
        return Datatables::of(Task::select('*')->orderBy('order'))
        ->addColumn('action', function ($cat) {
                     return '<a href="/admin/task/edit/'.$cat->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a><a href="/admin/task/delete/'.$cat->id.'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> delete</a>';
                 })->editColumn('id', '{{$id}}')
        ->make(true);
    }
    public function sortTable(Request $request){
        if ($request->isMethod('get')) {
              $sort_array = $request->sort;
              $Categorie = new Task();
              $Categorie->sortTable($sort_array);
        }
    }
}
