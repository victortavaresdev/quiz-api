<?php

namespace App\Http\Middleware;

use App\Exceptions\Custom\ForbiddenException;
use App\Exceptions\Custom\UnauthenticatedException;
use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            throw new UnauthenticatedException('Unauthenticated');
        }

        if (auth()->user()->role !== 'ADMIN') {
            throw new ForbiddenException('Forbidden access');
        }

        return $next($request);
    }
}
