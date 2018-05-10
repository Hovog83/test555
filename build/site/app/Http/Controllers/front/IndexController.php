<?php

namespace App\Http\Controllers\front;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Common\Categorie;
use App\Models\Common\Service;


class IndexController extends Controller
{
    public function index(){
        $categorie = new Categorie();
        $Service_m = new Service();
        $catLIst   = $categorie->getCategorieByActiv()->toArray(); 
        $service   =  $Service_m->orderByRaw("RAND()")->take(1)->first();
        $services  =  Service::orderByRaw("RAND()")->take(6)->get();
// getServiceMineImages
        return view('front.index',
            ["catLIst"=> $catLIst,"Service_m"=> $Service_m,"service"=> $service,"services"=> $services]
            );
    }

   /* public function login(Request $request){
        $salt        = User::getSaltByEmail($request->email);
        $credentials = [
            'role'     => User::ROLE_USER,
            'email'    => $request->email,
            'password' => $request->password . $salt
        ];
        if (Auth::attempt($credentials, true)) {
            return redirect('back/admin');
        }
    }*/
}

