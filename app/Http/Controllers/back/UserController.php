<?php

namespace App\Http\Controllers\back;

use App\Models\Common\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Yajra\Datatables\Datatables;

class UserController extends Controller{
    public function index(){
        return view('back.user.index');
    }
    public function addEdit(Request $request, $id = false) {
        $rules = User::rules();

    	if(!$id){
	    	$users = new User();
            $url = 'admin/user/create';
    	}else{
    		$users = User::find($id);
            $url = 'admin/user/edit/'.$id;
    	}       
        if ($request->isMethod('post')) {

            if($users->email != $request->email){
                $rules['email']  = 'required|unique:users';
            }            
            if($users->code != $request->code){
                $rules['code']  = 'required|unique:users';
            }      
          $validator = Validator::make($request->all(),$rules);
	        if ($validator->fails()) {
	            return redirect($url)
	                       ->withErrors($validator,'addEdit')
	                       ->withInput();
	        }else{
                if ($request->password) {
                    $user->salt = uniqid(rand(), true);
                    $user->password = bcrypt($request->password . $user->salt);
                }
                 $users->firstname    = $request->firstname;
                 $users->lastname     = $request->lastname;
                 $users->email        = $request->email;
                 $users->status       = $request->status;
                 $users->role         = $request->role;
                 $users->code         = $request->code;
                 $users->password     = $request->password;
         	  	 $users->save();
	        }
	        return redirect('admin/user');
        }
        return view('back.user.addEdit',["users"=>$users]);
    }
    public function delete($id) {
        User::find($id)->delete();
         return redirect('admin/user');
    }
    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData(){
        return Datatables::of(User::select('*'))
        ->addColumn('action', function ($cat) {
                     return '<a href="/admin/user/edit/'.$cat->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a><a href="/admin/user/delete/'.$cat->id.'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> delete</a>';
                 })->editColumn('id', 'ID: {{$id}}')
        ->make(true);
    }
}
