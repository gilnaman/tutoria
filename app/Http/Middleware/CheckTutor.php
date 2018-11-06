<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Illuminate\Support\Facades\Redirect;
class CheckTutor
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
        $rol= Session::get('usuario');
        if(empty($rol))
            return Redirect::to('/');
        else
        {
            if (Session::get('idrol')!=2)
                return Redirect::to('/');    
        }
        return $next($request);
    }
}
