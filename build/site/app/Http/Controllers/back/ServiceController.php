<?php

namespace App\Http\Controllers\back;

use App\Models\Common\Service;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Yajra\Datatables\Datatables;
use App\Models\Common\Categorie;
use App\Models\Common\Subcategory;
use App\Models\Common\Image;
use App\Helpers\Images_up;
use App\Models\Common\Language;

class ServiceController extends Controller{
    public function index(){
        return view('back.service.index',["type"=>null]);
    }    
    public function type($type){
        return view('back.service.index',["type"=>$type]);
    }

    public function addEdit(Request $request, $id = false) {
        $categorie = Categorie::where('status', '=', "ACTIVE")->select('id', 'name')->get();
        $subcategory = [];
        $cat = [null=>""];
        foreach ($categorie->toArray() as $key => $value) {
            $cat[$value["id"]] = $value["name"];
        }       
    	if(!$id){
	    	$services = new Service();
            $url = 'admin/service/create';
    	}else{
            $services = Service::find($id);
            $subcategory = Subcategory::getSubcategoryByCatIdForService($services->cat_id);
            $url = 'admin/service/edit/'.$id;
    	}
        if ($request->isMethod('post')) {
            $rules = Service::rules();
            $rules['images.*'] = 'image|max:2000';
          $validator = Validator::make($request->all(),$rules);
	        if ($validator->fails()) {
	            return redirect($url)->withErrors($validator,"addEdit")->withInput();
	        }else{
                    $up =  new Images_up();
                    $images = $up->upload();

                    $title = preg_replace('/[^a-z-0-9?]+/iu', '_', $request->title);
                    $language = array($title => $request->title);
                    Language::insertKey($language,$id);

                    $services->title       = $request->title;
                    $services->codeTitle   = $title;
                    $services->status      = $request->status;
                    $services->order       = $request->order;
                    $services->description = $request->description;
                    $services->cat_id      = $request->cat_id;
                    $services->subCat_id   = $request->subCat_id;
                    $services->save();



                    foreach ($images as $key => $value) {
                        $image_model = new Image();
                        $image_model->service_id = $services->id;
                        $image_model->image      = $value;
                        $image_model->order      =  $key;
                        $image_model->save();
                    }
	        }
	        return redirect('admin/service');
        }
        return view('back.service.addEdit',["services"=>$services,"cat"=>$cat,"subcategory"=>$subcategory]);
    }
    public function delete($id) {
        Service::find($id)->delete();
         return redirect('admin/service');
    }   



    public function getSubCat($id = false ) {
        $subcategory = array();
        if($id){
            $subcategory = Subcategory::getSubcategoryByCatIdForService($id);
        }
        echo json_encode($subcategory);die;
    }    
    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData($type = null){

        if(!$type){
            $anyData =  Datatables::of(Service::select('*'));
        }else{
            $anyData =  Datatables::of(Service::select('*')->where('status', '=',strtoupper($type)));
        }
        return $anyData->addColumn('action', function ($cat) {
                     return '<a href="/admin/service/edit/'.$cat->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a><a href="/admin/service/delete/'.$cat->id.'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> delete</a>';
                 })->editColumn('id', 'ID: {{$id}}')
        ->make(true);
    }

    public function sortImages(Request $request) {
        if ($request->isMethod('get')) {
              $sort_array = $request->images;
              $image_model = new Image();
              $image_model->sortImages($sort_array);
        }
      }
      public function setMainImages($id,$services) {
          $image_model = new Image();
          $image_model->setMainImages($id,$services);
          echo "true";
      }
      
      public function deleteImages($id) {
          $image_model = Image::find($id);
          $up =  new Images_up();
          $images = $up->deleteImages($image_model->image);
          Image::find($id)->delete();
          echo "true";
      }

}
