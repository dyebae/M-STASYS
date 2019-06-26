<?php

namespace App\Http\Middleware;

use Closure;

class cekSessionAdmin
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
        if(\Session::get('logged_in')[0] == "admin" or \Session::get('logged_in')[0] == "kepsek")
			return $next($request);
		return redirect('/restricted');
	}
}
