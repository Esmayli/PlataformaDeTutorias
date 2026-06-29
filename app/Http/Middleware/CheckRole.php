<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $rol): Response
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        if (auth()->user()->rol !== $rol) {
            if (auth()->user()->rol === 'tutor') {
                return redirect('/tutor/dashboard');
            }
            return redirect('/estudiante/dashboard');
        }

        return $next($request);
    }
}