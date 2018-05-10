<?php

namespace App\Http\Controllers\front;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Common\Categorie;
use App\Models\Common\Subcategory;
use App\Models\Common\Service;
use Session;

class ServiceController extends Controller{

    public function check($lg,$id=null){
        session()->regenerate();
        $value = Session::get('check');
        $value[] = $id;
        Session::push('check',$value );
        session(['check' => $value ]);
        Session::set('check', $value);
        if (Session::has('check'))
        {
            $x = Session::get('check');
            echo "<pre>";
$value = session('check');
        print_r($value);die;
           
        }
        
            echo "12";
        print_r(Session::get('check'));die;


    }
    public function index($lg,$id=null){
        $categorie    = new Categorie();
        $subcategory  = new Subcategory();
        $serviceModel = new Service();
        $service      = $serviceModel->getService($id);
        $serviceImges = $service->getServiceImages()->toArray();
        $service      =  $service->toArray();
        $view         = 'front.service.service';
        $data         = array(
                "categorie"    => $categorie,
                "serviceModel" => $serviceModel,
                "subcategory"  => $subcategory,
                "serviceImges" => $serviceImges,
                "service"      => $service,
            );
       return view($view,$data);
    }
}