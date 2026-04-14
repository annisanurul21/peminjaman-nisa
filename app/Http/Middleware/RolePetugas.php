<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RolePetugas
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->role === 'petugas') {
            return $next($request);
        }
        abort(403, 'Akses ditolak. Hanya Petugas yang bisa masuk.');
    }
}