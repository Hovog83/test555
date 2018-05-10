<?php

namespace App\Http\Controllers\front;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Yajra\Datatables\Datatables;
use App\Models\Common\Categorie;
use App\Models\Common\Subcategory;
use App\Models\Common\Service;
use App\Models\Common\Image;
use App\Helpers\Images_up;
use App\Models\Common\Language;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller{

    public $user;

    public function __construct()
    {
        $this->user = Auth::user();
            return redirect('/');
         // if(!isset($this->user->role) ){
         // }
    }

    public function index($lg){
        return view('front.account_service.index');
    }    
   
    public function addEdit($lg,Request $request, $id = false) {
            $categorie = Categorie::where('status', '=', "ACTIVE")->select('id', 'name')->get();
            $subcategory = [];
            $cat = [null=>""];
            foreach ($categorie->toArray() as $key => $value) {
                $cat[$value["id"]] = $value["name"];
            }       
            if(!$id){
                $services = new Service();
                $url = '/classifieds/create';
            }else{
                $services = Service::find($id);
                $subcategory = Subcategory::getSubcategoryByCatIdForService($services->cat_id);
                $url = '/classifieds/edit/'.$id;
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

                        // $title = preg_replace('/[^a-z-0-9?]+/iu', '_', $request->title);
                        // $language = array($title => $request->title);
                        // Language::insertKey($language,$id);

                        $services->title       = $request->title;
                        // $services->codeTitle   = $title;
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
                return redirect('classifieds');
            }
            return view('front.account_service.addEdit',["services"=>$services,"cat"=>$cat,"subcategory"=>$subcategory]);
        }

        public function delete($id) {
            Service::find($id)->delete();
             return redirect('classifieds/');
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
        public function anyData(){

            $anyData =  Datatables::of(Service::select('*')->where('user_id', '=' ,$this->user->id));

            return $anyData->addColumn('image', function ($image) {
                       $img = Service::getServiceMineImages($image->id)->image;
                       if(!empty($img)){
                          return ' <img src="/uploads/miny_'.$img.'" alt="">';
                       }
                       return "";
                     })->addColumn('info', function ($info) {
                        return '<div class="company-content">
                            <h5 class="company-title"><a href="#">'.$info->title.'</a></h5>
                            <p class="company-describe">'.$info->description.'</p>
                            <a href="/service/'.$info->id.'" class="read_more"><i class="glyphicon glyphicon-edit"></i></a>
                            <a href="/service/'.$info->id.'" class="read_more"><i class="glyphicon glyphicon-trash"></i> </a>
                        </div>';

                     })


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