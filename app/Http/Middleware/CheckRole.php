<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next, $role)
    {
        if (!auth()->check()) {
            return $next($request);
        }

        $user = auth()->user();

        // Simpan URL asal jika pengguna mencoba mengakses URL yang tidak diizinkan
        if ($user->status !== $role) {
            session(['original_url' => url()->previous()]);
        }

        $allowedRoutes = [];

        switch ($role) {
            case 'Administrator':
                $allowedRoutes = [
                    'user.index',
                    'user.store',
                    'user.edit',
                    'user.update',
                    'user.destroy',
                ];
                break;

            case 'Petugas':
                $allowedRoutes = [
                    'transaksi.index',
                    'transaksi.store',
                    'transaksi.create',
                    'transaksi.edit',
                    'transaksi.update',
                    'transaksi.destroy',
                    'detail-transaksi.create',
                    'detail-transaksi.destroy',
                ];
                break;
        }

        if ($user->status === $role && in_array($request->route()->getName(), $allowedRoutes)) {
            return $next($request);
        }

        abort(403, 'Unauthorized action.');
    }
}
