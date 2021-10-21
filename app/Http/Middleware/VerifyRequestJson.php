<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyRequestJson
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->expectsJson()) {
            abort(503, 'Requisição inválida.');
        }
        return $next($request);
    }
}
