<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Userauth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->session()->has('FRONT_USER_LOGIN')){
            

        }else{
            $request->session()->flash('msg','access denied');
            return redirect('/');
        }
          
        return $next($request);
    }
}
