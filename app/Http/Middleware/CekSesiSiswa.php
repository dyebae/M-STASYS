<?php

namespace App\Http\Middleware;

use Closure;

class CekSesiSiswa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(\Session::get('logged_in')[0] == "siswa")
			return $next($request);
		return redirect('/restricted');
    }
}
