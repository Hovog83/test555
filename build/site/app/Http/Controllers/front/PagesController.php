<?php

namespace App\Http\Controllers\front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Common\Pages;

class PagesController extends Controller
{
    public function index($lg,$slug){
        $page = Pages::getPageBySlug($slug);
        if(empty($page)){
         return redirect($lang . '/');
        }
        return view('front.page.index',["page" => $page]);
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
    } */
}

