<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check() && auth()->user()->role === 'taller') {
            return $next($request);
        }
        else if(auth()->check() && auth()->user()->role === 'cliente') {
            abort(403, "Acesso Denegado");
        }
        else {
            return redirect('/login');
        }
    }
}
