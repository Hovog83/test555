<?php
namespace App\Http\Controllers\back;

use App\Models\Common\Categorie;
use App\Models\Common\Subcategory;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Yajra\Datatables\Datatables;
use App\Models\Common\Language;

class SubcategoryController extends Controller{
    public function index(){
        return view('back.subcategory.index');
    }
    public function addEdit(Request $request, $id = false) {
        $categorie = Categorie::where('status', '=', "ACTIVE")->select('id', 'name')->get();
        foreach ($categorie->toArray() as $key => $value) {
            $cat[$value["id"]] = $value["name"];
        }
    	if(!$id){
	    	$subcategory = new Subcategory();
            $url = 'admin/subcategory/create';
    	}else{
    		$subcategory = Subcategory::find($id);
            $url = 'admin/subcategory/edit/'.$id;
    	}
        if ($request->isMethod('post')) {
          $validator = Validator::make($request->all(),Subcategory::rules());
	        if ($validator->fails()) {
	            return redirect($url)
	                       ->withErrors($validator,'addEdit')
	                       ->withInput();
	        }else{
                
                $name = preg_replace('/[^a-z-0-9?]+/iu', '_', $request->name);
                $language = array($name => $request->name);
                Language::insertKey($language,$id);

                 $subcategory->name   = $request->name;
                 $subcategory->codeTitle = $name;
                 $subcategory->cat_id = $request->cat_id;
                 $subcategory->icone  = $request->icone; 
                 $subcategory->order  = $request->order;
                 $subcategory->status = $request->status;
         	  	 $subcategory->save();

	        }
	        return redirect('admin/subcategory');
        }
        return view('back.subcategory.addEdit',["subcategory"=>$subcategory,"cat"=>$cat]);
    }
    public function delete($id) {
        Subcategory::find($id)->delete();
         return redirect('admin/subcategory');
    }
    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData(){
        return Datatables::of(Subcategory::select('*')->orderBy('order'))
        ->addColumn('action', function ($cat) {
                     return '<a href="/admin/subcategory/edit/'.$cat->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a><a href="/admin/subcategory/delete/'.$cat->id.'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> delete</a>';
                 })->editColumn('id', '{{$id}}')
        ->make(true);
    }
    public function sortTable(Request $request){
        if ($request->isMethod('get')) {
              $sort_array = $request->sort;
              $Categorie = new Subcategory();
              $Categorie->sortTable($sort_array);
        }
    }
}
