<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Nhansu;


class checkUser
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
        $id = Auth::id();
        $check =  Nhansu::firstWhere('MANV', $id);

        if ($check->QUANTRI === 'nhanvien') {
            return $next($request);
        }
        else {
            return redirect('/')->with('alert', 'You not nhanvien!!!');
        }
    }
}
