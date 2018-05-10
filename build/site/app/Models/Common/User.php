<?php

namespace App\Models\common;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    const ROLE_ADMIN = 'ADMIN';
    const ROLE_USER = 'USER';
    const STATUS_NEW = 'NEW';
    const STATUS_BLOCKED = 'BLOCKED';
    const STATUS_ACTIVE = 'ACTIVE';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'firstname','lastname', 'email', 'password','role','status'
    ];

    public static function rules()
    {
        return [
                'firstname'    => 'required|max:50|min:2',
                'lastname'     => 'required|max:30',
                'email'        => 'required',
                'role'         => 'required',
                'status'       => 'required',
                'address'      => 'required',
                'home_phone'   => 'required|integer',
                'mobile_phone' => 'required|integer'
        ];
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public static function  _save($request, $id = false){
        if ($id) {
            $user = self::find($id);
        } else {
            $user = new User();
            $user->token = md5(microtime(true));
        }
        if ($request->password) {
            $user->salt = uniqid(rand(), true);
            $user->password = bcrypt($request->password . $user->salt);
        }

        $user->email = $request->email;
        $user->role = User::ROLE_USER;
        $user->status = User::STATUS_BLOCKED;
        if($user->save()){
            if(!$id){
                return $user->token;
            }
            return true;
        }
        return false;
    }
    public static function getSaltByEmail($email){
        return self::where('email', $email)->value('salt');
    }
    public static function checkRegistered($email){
        return self::where('email', $email)->first();
    }
    public static function getTokenByEmail($email){
        return self::where('email', $email)->value('remember_token');
    }
    public static function getStatusByEmail($email){
        return self::where('email', $email)->value('status');
    }

    public static function checkToken($token){

        return self::where('token', $token)->first();
    }
    public static function getUserbyEmail($email){
        return  self::where('email',$email)->first();
    }
    public static function updateStatus($token){
        return self::where('token', $token)->update(['status' => 'ACTIVE']);

    }
    public static function deleteActivationToken($token){
       return self::where('token', $token)->update(['token' => NULL]);

    }
    public static  function generateToken($request){
        $token = md5(microtime(true));
        self::where('email',$request->email)->update(['token' => $token]);
        return $token;
    }
    public static  function resetPassword($request, $token){

            $salt = self::where('token', $token)->value('salt');
            self::where('token',$token)->update(['password' => bcrypt($request->password . $salt)]);

    }
}
