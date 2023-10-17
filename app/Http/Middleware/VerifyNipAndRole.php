<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class VerifyNipAndRole
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user && ($user->employee->nip === $request->nip || $user->role === 'admin')) {
            return $next($request);
        }

        abort(403, 'Unauthorized'); // Akses tidak diizinkan
    }
}

