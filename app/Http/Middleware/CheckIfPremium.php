<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIfPremium
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Supondo que o campo 'is_premium' na tabela users define o plano
        if (!auth()->check() || !auth()->user()->is_premium) {
            return redirect('/')->with('error', 'Acesso restrito a usuários premium.');
        }

        return $next($request);
    }
}
