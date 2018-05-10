<?php

namespace App\Http\Controllers\back;

use App\Models\Common\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Yajra\Datatables\Datatables;
class userController extends Controller{
    public function index(){
        return view('back.user.index');
    }
    public function addEdit(Request $request, $id = false) {
    	if(!$id){
	    	$users = new user();
            $url = 'admin/user/create';
    	}else{
    		$users = user::find($id);
            $url = 'admin/user/edit/'.$id;
    	}
        if ($request->isMethod('post')) {
          $validator = Validator::make($request->all(),user::rules());
	        if ($validator->fails()) {
	            return redirect($url)
	                       ->withErrors($validator,'addEdit')
	                       ->withInput();

	        }else{
                 $users->firstname    = $request->firstname;
                 $users->lastname     = $request->lastname;
                 $users->email        = $request->email;
                 $users->status       = $request->status;
                 $users->address      = $request->address;
                 $users->role         = $request->role;
                 $users->home_phone   = $request->home_phone;
                 $users->mobile_phone = $request->mobile_phone;
         	  	 $users->save();
	        }
	        return redirect('admin/user');
        }
        return view('back.user.addEdit',["users"=>$users]);
    }
    public function delete($id) {
        user::find($id)->delete();
         return redirect('admin/user');
    }
    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData(){
        return Datatables::of(user::select('*'))
        ->addColumn('action', function ($cat) {
                     return '<a href="/admin/user/edit/'.$cat->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a><a href="/admin/user/delete/'.$cat->id.'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> delete</a>';
                 })->editColumn('id', 'ID: {{$id}}')
        ->make(true);
    }
}
