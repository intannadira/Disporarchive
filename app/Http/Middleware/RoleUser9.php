<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleUser9
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
        if(auth()->user()->jabatan_id == '13'){
            return $next($request);
        }else{
            abort(403);
        }
    }
}
