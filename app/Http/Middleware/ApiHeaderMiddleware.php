<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiHeaderMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $request->headers->set('Accept', 'application/json');
        $request->header('Accept', 'application/json');
        $response = $next($request);
        $response->headers->set('Accept', 'application/json');
        $response->header('Accept', 'application/json');
        return $response;
    }
}
