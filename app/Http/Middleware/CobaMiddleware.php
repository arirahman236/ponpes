<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CobaMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (time() % 2 == 0) {
            return redirect('/tabel-mahasiswa');
        }
        //dd('cabaModdleware aktif');
        return $next($request);
    }
}
