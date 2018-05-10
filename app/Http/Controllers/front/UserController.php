<?php
namespace App\Http\Controllers\front;

use App\Models\Common\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller {

    public function login(Request $request){

        if($request->isMethod('post')){
            $rules = [
                "code"    => "required",
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())
                    ->withInput(Input::except([
                        'password',
                    ])
                );
            }
            $user = User::getStatusByCode($request->code);

            if (!empty($user) && Auth::loginUsingId($user->id)) {
                return redirect('/user');
            }
            return redirect()->back()->withErrors(['form' => 'Invalid code'])->withInput(Input::except(['password']));
        }
        $title = 'Login';

        return view('front.loginUser', ['title' => $title]);
    } 
    public function auth(Request $request){
        if($request->isMethod('post')){
            $rules = [
                "email"    => "required|email",
                "password" => "required|min:6|max:20",
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())
                    ->withInput(Input::except([
                        'password',
                    ])
                );
            }
            $status = User::getStatusByEmail($request->email);
            if(!$status){
                $this->register($request);
                $request->session()->flash('message', 'Please verify your email to login!');
                return redirect()->back();
            }elseif($status == 'BLOCKED'){
                $request->session()->flash('message', 'Please verify your email to login!');
                return redirect()->back();
            }

            $salt        = User::getSaltByEmail($request->email);
            $credentials = [
                'email'    => $request->email,
                'password' => $request->password . $salt
            ];
            $remember = ($request->remember == 'on')?true:false;
            if (Auth::attempt($credentials, $remember)) {
                return redirect('admin');
            }
            return redirect()->back()->withErrors(['form' => 'Invalid Username or Password'])->withInput(Input::except(['password']));
        }
        $title = 'Login';

        return view('front.login', ['title' => $title]);
    }

    public function logout () {
        Auth::logout();
        return redirect('/');
    }

}
