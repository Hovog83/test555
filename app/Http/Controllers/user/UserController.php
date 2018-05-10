<?php
namespace App\Http\Controllers\user;

use App\Models\Common\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller {

    public function logout () {
        Auth::logout();
        return redirect('/');
    }

}
