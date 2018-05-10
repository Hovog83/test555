<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\common\User;
use Illuminate\Contracts\Auth\Guard;
class Admin
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('/');
            }
        } else {
            if (User::ROLE_ADMIN != $this->auth->user()->role) {
                return redirect('user');
            }
        }
        return $next($request);
    }
}
