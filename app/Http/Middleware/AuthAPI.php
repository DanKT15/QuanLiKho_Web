<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Nhansu;


class AuthAPI
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

        if (Auth::check()) {

            $id = Auth::id();
            $check =  Nhansu::firstWhere('MANV', $id);

            if ($check->QUANTRI === 'nhanvien') {
                return $next($request);
            }
            else {
                return response(['message' => 'You are not authorized to use the system'], 200);
            }

        }
        else {
            return response(['message' => 'You are not logged into the system'], 200);
        }

    }
}