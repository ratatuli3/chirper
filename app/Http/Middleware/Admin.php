<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
{
    public function handle(Request $request, Closure $next)
    {
        if(Auth()->user()->usertype=='admin')
        {
            return $next($request);
        } 
        
        abort(401);

    }
}
