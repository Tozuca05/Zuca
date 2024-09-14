<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        dd('Usuario autenticado:', Auth::user()); // Mostrará los detalles del usuario autenticado
        if (Auth::check() && Auth::user()->role == 'admin') {
            return $next($request);
        }
    
        return redirect('/');
    }
}    
