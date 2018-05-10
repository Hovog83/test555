<?php

namespace App\Http\Controllers\front;

use App\Models\Common\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index () {
        $title = 'Login';
        return view('front.login', ['title' => $title]);
    }

    public function login (Request $request) {
        $rules = [
            "email" => "required|email",
            "password" => "required|min:6|max:20",
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput(Input::except([
                'password',
            ]));
        }
        $status = User::getStatusByEmail($request->email);

        if(!$status){
            return redirect()->action('front\UserController@register', [$request->email, $request->password]);
        }
        $salt        = User::getSaltByEmail($request->email);
        $credentials = [
            'role'     => User::ROLE_ADMIN,
            'email'    => $request->email,
            'password' => $request->password . $salt
        ];
        if (Auth::attempt($credentials, true)) {
            User::noteUserLogin(Auth::user());

            return redirect('admin');
        }

        return redirect()->back()->withErrors(['form' => 'Invalid Username or Password'])->withInput(Input::except(['password']));
    }

    public function logout () {
        Auth::logout();

        return redirect('admin/auth');
    }
}
