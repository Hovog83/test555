<?php

namespace App\Http\Controllers\user;
use App\User;
use \Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Common\Task;
use App\Models\Common\UserTask;

class IndexController extends Controller{
    
    public function index(){

    	 $user_task = UserTask::where([
    	 		'user_id' => Auth::user()->id,
    	 	]);
    
		 $active = $user_task->with(['active','test','dan','bug'])->get()->toArray();
		 $user_task =  array();
		 foreach ($active as $key => $value) {
		 	(!empty($value["active"])) ? $user_task["active"][]    =   $value["active"] : "";
		 	(!empty($value["test"]))   ? $user_task["test"][]      =   $value["test"]   : "";
		 	(!empty($value["dan"]))    ? $user_task["dan"][]       =   $value["dan"]    : "";
		 	(!empty($value["bug"]))    ? $user_task["bug"][]       =   $value["bug"]    : "";
		 }
		 // echo "<pre>";
		 // print_r($user_task);die;
		// $user_task = [
		// 	"active" => $active,
		// 	"test"   => $test,
		// 	"bug"    => $bug,
		// 	"dan"    => $dan
		// ];
        return view('user.index',['user_task'=>$user_task]);
    }

}

