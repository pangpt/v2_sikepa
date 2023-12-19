<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LimitDemoUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
      if (auth()->check() && auth()->user()->hasRole('demo')) {
        // Periksa jenis request, jika POST, PUT, DELETE, dsb, tolak akses
        if ($request->isMethod('post') || $request->isMethod('put') || $request->isMethod('delete')) {
            // Anda bisa redirect atau mengembalikan response khusus
            return redirect('/')->with('error', 'Akses terbatas pada akun demo.');
        }
    }

    return $next($request);
    }
}
