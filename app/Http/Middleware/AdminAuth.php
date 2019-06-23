<?php

namespace App\Http\Middleware;

use Closure;
use auth;
class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    { 
      
        if(!Auth::guard('admin')->check()){ 
           
            return  redirect('admin/login')->with('delete-message', 'course Removed');
        }
       
        return $next($request);
    }
}
