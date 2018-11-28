<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
	//karthick 
	//if logged in go the respective page else redirect to login page. 
    public function handle($request, Closure $next)
    {
         if(Auth::check()) {
            return $next($request);
        }else{
            return redirect('login');
        }
	}

}
