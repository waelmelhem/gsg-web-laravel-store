<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class SetAppLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {   
        // $default="en";
        // $langBrows=$request->header('accept-language');
        // if($langBrows){
        //     $lang=explode(',',$langBrows)[0];
        //     if(strlen($lang)==2){
        //         $default=$lang;

        //     }
        //     else{
        //         $default=substr($lang,0,2);
        //     }
        // }
        // $locale=$request->input("lang",Session::get('locale',$default));
        // App::setLocale($locale);
        // Session::put(['locale'=>$locale]);
        // $locale=$request->route('locale','en');
        // URL::defaults(
        //     ['locale'=>$locale]
        // );
        // Route::current()->forgetParameter('locale');
        // App::setLocale($locale);
        return $next($request);
    }
}
