<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();

        if ($role === 'owner' && $user->role !== 'owner') {
            return redirect()->route('filament.cashier.pages.dashboard'); // Ganti dengan rute yang sesuai
        }

        if ($role === 'cashier' && $user->role === 'owner') {
            return redirect()->route('filament.cashier.pages.dashboard'); // Ganti dengan rute yang sesuai
        }

        return $next($request);
    }
}