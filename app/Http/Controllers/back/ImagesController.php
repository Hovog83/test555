<?php

namespace App\Http\Controllers\back;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Yajra\Datatables\Datatables;
use App\Models\Common\Image;
use App\Helpers\Images_up;
use DB;

class ImagesController extends Controller{

    public function add(Request $request) {
         $image_model = DB::table('page_image');
         $images = $image_model->get();
        if ($request->isMethod('post')) {
            $rules['images.*'] = 'image|max:2000';
          $validator = Validator::make($request->all(),$rules);
	        if ($validator->fails()) {
	            return redirect($url)->withErrors($validator,"addEdit")->withInput();
	        }else{
                    $up =  new Images_up();
                    $up->path = "page";
                    $images = $up->upload();
                    foreach ($images as $key => $value) {
                      DB::table('page_image')->insert([
                          ['image' =>$value],
                      ]);
                    }
	        }
	        return redirect('admin/images');
        }
        return view('back.image.addEdit',["image_model"=>$image_model,"images"=>$images]);
    }
      
      public function deleteImages($id) {

         $image_model = DB::table('page_image')->where('id', $id)->first();
          $up =  new Images_up();
          $up->path = "page";
          $images = $up->deleteImages($image_model->image);
          $image_model = DB::table('page_image')->where('id', $id)->delete();
          echo "true";
      }

}
