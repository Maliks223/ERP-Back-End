<?php

namespace App\Http\Middleware;
use App\Http\Middleware\Auth;
use Closure;
use Illuminate\Http\Request;

class SuperAdminMiddleware
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

        if(Auth::check()){
            if(Auth::user()->role == "1"){
            
            return $next($request);
            
            }else{
               return "kusa blaban";
            
                }
            
            }else{
                return "lllll";
            
            
            
            }
        return $next($request);
    
    }

}


