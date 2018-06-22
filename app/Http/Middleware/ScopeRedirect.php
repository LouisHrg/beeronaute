<?php

namespace App\Http\Middleware;

use Closure;

class ScopeRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $manage,$admin)
    {
        
        $response = $next($request);

        dd($)

        if(\Auth::user()->hasRole('manager')){
            return redirect()->route($manage);
        }
        if(\Auth::user()->hasRole('admin')){
            return redirect()->route($admin);
        }

        return $next($request);
    }
}
