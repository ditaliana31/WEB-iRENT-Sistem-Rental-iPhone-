<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // cek login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // ambil role user
        $role = strtolower(trim(Auth::user()->role ?? ''));

        // cek admin
        if ($role !== 'admin') {

            abort(403, 'Akses ditolak. Halaman khusus admin.');
        }

        return $next($request);
    }
}
