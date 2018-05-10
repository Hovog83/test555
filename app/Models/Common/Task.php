<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;

class Task extends Model{


	const STATUS_ACTIVE = 'ACTIVE';
	const STATUS_DAN = 'DAN';
	const STATUS_BUG = 'BUG';
	const STATUS_TEST = 'TEST';
	
    protected $table = 'task';
	
	public static function rules()
	{
		return [
				'title' => 'required|max:50|min:2',
				'description' => 'required|max:255|min:2',
				'start_date'  => 'required',
				'end_date'  => 'required',
				'status'  => 'required',
		];
	}
	public function sortTable($sort_array) {
        foreach ($sort_array as $key => $sort) {
        	$sort = self::find($sort);
        	$sort->order = $key;
        	$sort->save();
        }
    }

    public function getUserTask(){
        return $this->hasOne('App\Models\Common\UserTask', 'task_id', 'id');
    }	

    public static function updateTaskStatus($id){
    	$task = self::find($id);
        $task->status = self::STATUS_TEST;
        $task->save();
        return true;
    }
}