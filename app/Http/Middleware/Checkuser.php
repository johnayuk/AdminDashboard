<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Checkuser
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

        if(Auth::user()->role === doctor|| Auth::user()->role ===patient || Auth::user()->role === nurse || Auth::user()->role === worker){
            return $next($request);
        }else{
            return redirect('/dashboard')->withErrors(['status' => 'Unauthorized action']);
        }
        return $next($request);
    }
}
