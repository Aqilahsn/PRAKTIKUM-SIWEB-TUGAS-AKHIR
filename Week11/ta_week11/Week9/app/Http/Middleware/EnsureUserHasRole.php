<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Cek apakah user yang login memiliki role yang diperlukan.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!$request->user() || $request->user()->role !== $role) {
            abort(403, 'Akses ditolak. Halaman ini hanya untuk ' . $role . '.');
        }

        return $next($request);
    }
}
