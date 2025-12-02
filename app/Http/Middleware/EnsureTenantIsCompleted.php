<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTenantIsCompleted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // se não estiver logado, deixa o 'auth' cuidar disso
        if (! $user) {
            return $next($request);
        }

        $tenant = $user->tenant ?? null; // ajuste se o relacionamento tiver outro nome

        // se não tiver tenant ainda, você pode mandar pra uma tela de criação
        if (! $tenant) {
            // ex.: return redirect()->route('tenants.create');
            return $next($request); // por enquanto não trava
        }

        // evita loop: deixa passar nas rotas de completar cadastro
        if ($request->routeIs('tenants.complete', 'tenants.complete.store')) {
            return $next($request);
        }

        // aqui você checa como marca "completo" na tabela tenants
        // ajuste o nome do campo (ex.: 'is_completed' ou 'completed_at')
        if (empty($tenant->is_completed)) {
            return redirect()->route('tenants.complete', $tenant->id);
        }

        return $next($request);
    }
}
