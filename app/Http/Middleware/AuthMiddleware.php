<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!empty(Auth::check())){
            if(Auth::user()->is_admin==1 || Auth::user()->is_admin==2){
                return $next($request); 
            }else{
                Auth::logout();
                session()->flash("error","Please log in with the admin account");
                return redirect(url("/login"));
            }
        }
        else{
            Auth::logout();
            return redirect(route("login"));
        }
    }
}
