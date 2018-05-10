<?php

namespace App\Http\Controllers\back;

use App\Models\Common\Categorie;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Yajra\Datatables\Datatables;
use App\Models\Common\Language;

class CategorieController extends Controller{
    public function index(){
        return view('back.categorie.index');
    }
    public function addEdit(Request $request, $id = false) {
    	if(!$id){
	    	$categories = new Categorie();
            $url = 'admin/categorie/create';
    	}else{
    		$categories = Categorie::find($id);
            $url = 'admin/categorie/edit/'.$id;
    	}
        if ($request->isMethod('post')) {
          $validator = Validator::make($request->all(),Categorie::rules());
	        if ($validator->fails()) {
	            return redirect($url)
	                       ->withErrors($validator,'addEdit')
	                       ->withInput();
	        }else{
                $name = preg_replace('/[^a-z-0-9?]+/iu', '_', $request->name);
                $language = array($name => $request->name);
                Language::insertKey($language,$id);
                 
                 $categories->codeTitle = $name;
                 $categories->name      = $request->name;
                 $categories->icone     = $request->icone;
                 $categories->order     = $request->order;
                 $categories->status    = $request->status;
         	  	 $categories->save();

	        }
	        return redirect('admin/categorie');
        }
        return view('back.categorie.addEdit',["categories"=>$categories]);
    }
    public function delete($id) {
        Categorie::find($id)->delete();
         return redirect('admin/categorie');
    }
    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData(){
        return Datatables::of(Categorie::select('*')->orderBy('order'))
        ->addColumn('action', function ($cat) {
                     return '<a href="/admin/categorie/edit/'.$cat->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a><a href="/admin/categorie/delete/'.$cat->id.'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> delete</a>';
                 })->editColumn('id', '{{$id}}')
        ->make(true);
    }
    public function sortTable(Request $request){
        if ($request->isMethod('get')) {
              $sort_array = $request->sort;
              $Categorie = new Categorie();
              $Categorie->sortTable($sort_array);
        }
    }
}
