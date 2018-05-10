<?php

namespace App\Http\Controllers\back;

use App\Models\Common\menu;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Yajra\Datatables\Datatables;
class MenuController extends Controller{
    public function index(){
        return view('back.menu.index');
    }
    public function addEdit(Request $request, $id = false) {
    	if(!$id){
	    	$menus = new Menu();
            $url = 'admin/menu/create';
    	}else{
    		$menus = Menu::find($id);
            $url = 'admin/menu/edit/'.$id;
    	}
        if ($request->isMethod('post')) {
          $validator = Validator::make($request->all(),Menu::rules());
	        if ($validator->fails()) {
	            return redirect($url)
	                       ->withErrors($validator,'addEdit')
	                       ->withInput();

	        }else{
                 $menus->name    = $request->name;
         	  	 $menus->save();
	        }
	        return redirect('admin/menu');
        }
        return view('back.menu.addEdit',["menus"=>$menus]);
    }
    public function delete($id) {
        Menu::find($id)->delete();
         return redirect('admin/menu');
    }
    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData(){
        return Datatables::of(Menu::select('*'))
        ->addColumn('action', function ($cat) {
                     return '<a href="/admin/menu/edit/'.$cat->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a><a href="/admin/menu/delete/'.$cat->id.'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> delete</a><a href="/admin/menu/view/'.$cat->id.'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> View</a>';
                 })->editColumn('id', '{{$id}}')
        ->make(true);
    }
}
