<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class ManagerAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next)
    {
      
       if(Auth::check() && Auth::user()->is_manager == 1) {

            return $next($request);
        }
        
        return response()->json(['You do not have permission to access to Admin Panel']);
    }

}

