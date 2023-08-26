<?php

namespace App\Http\Middleware;

use App\Traits\RespondsWithJson;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    use RespondsWithJson;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // abort_unless(
        //     $request->user() && auth()->check() && $request->user()->is_admin == true,
        //     Response::HTTP_UNAUTHORIZED,
        // );
        if ($request->user() && auth()->check() && $request->user()->is_admin == true) {
            return $next($request);
        }
        return $this->error('Unauthorized', Response::HTTP_UNAUTHORIZED);
    }
}
