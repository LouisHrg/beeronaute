<?php

namespace App\Http\Middleware;

use Closure;

class OwnerWare
{

    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
