<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AuthAdmin extends Middleware
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
//        dd(session('utype')==="ADM",session('utype'));
        if(session('utype')==="ADM"){

            return $next($request);
        }else {

            session()->flush();
            return redirect()->route('login');
        }

        return $next($request);
    }
}
