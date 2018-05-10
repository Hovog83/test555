<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;

class UserTask extends Model{

    protected $table = 'user_task';
	
	public static function rules()
	{
		return [
				'user_id'   => 'required|exists:user,id',
				'task_id'  => 'required|exists:task,id',
		];
	}
	public function getUser(){
	    return $this->hasOne('App\Models\Common\User', 'id', 'user_id');
	}	
	public function getTask(){
	    return $this->hasOne('App\Models\Common\Task', 'id', 'task_id');
	}

	public function active(){
	    return $this->hasOne('App\Models\Common\Task', 'id', 'task_id')->where('status',"ACTIVE");
	}	
	public function test(){
	    return $this->hasOne('App\Models\Common\Task', 'id', 'task_id')->where('status','TEST');
	}	
	public function dan(){
	    return $this->hasOne('App\Models\Common\Task', 'id', 'task_id')->where('status','DAN');
	}	
	public function bug(){
	    return $this->hasOne('App\Models\Common\Task', 'id', 'task_id')->where('status','BUG');
	}	
}