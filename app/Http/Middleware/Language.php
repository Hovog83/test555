<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
// use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Support\Facades\Cookie;
use App\Models\Common\Language as Lang;
use Illuminate\Support\Facades\Config;

class Language{

    public function __construct(Application $app, Redirector $redirector, Request $request) {

        $local = [];
        $language = Lang::getLanguages(Lang::STATUS_ACTIVE);
        foreach($language as $lang){
            if($lang->fallback_locale){
                Config::set('app.fallback_locale', $lang->code);
            }
            $local[$lang->code] = $lang->name;
        }
        Config::set('app.locale', $local); 

        $this->app = $app;
        $this->redirector = $redirector;
        $this->request = $request;
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
        // Make sure current locale exists.
        $locale = $request->segment(1);

        if ( ! array_key_exists($locale, $this->app->config->get('app.locale'))) {

            $segments = $request->segments();
            $search = !empty($request->all())?"?" . http_build_query($request->all(), '', '&'):'';

            ///check if user has cookie
            $cookie = md5($request->ip());
            if($lang = Cookie::get($cookie)){
                $language = $lang;
            }else{
                $language = $this->app->config->get('app.fallback_locale');
            }

            //check if user requesting to api
            if( in_array($locale, $this->app->config->get('api.route')) ){
                return $this->redirector->to($language . '/' . implode('/', $segments) . $search);
            }
            $segments[0] = $language;
            return $this->redirector->to(implode('/', $segments) . $search);
        }

        $this->app->setLocale($locale);

        $cookie = md5($request->ip());
        if($locale != Cookie::get($cookie)){
            return $next($request)->withCookie(cookie()->forever($cookie, $locale));
           // return $next($request);
        }
        return $next($request);

    }

}