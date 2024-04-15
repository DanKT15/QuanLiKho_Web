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

            $header = $request->header('X-CSRF-TOKEN');
            $token = csrf_token();

            if (!empty($header) && !empty($token)) {

                if ($header === $token) {
                    
                    $id = Auth::id();
                    $check =  Nhansu::firstWhere('MANV', $id);

                    if ($check->QUANTRI === 'nhanvien') {
                        return $next($request)
                        ->header('Access-Control-Allow-Origin', 'http://localhost:8081')
                        ->header('Access-Control-Allow-Methods', '*')
                        ->header('Access-Control-Allow-Credentials', 'true')
                        ->header('Access-Control-Allow-Headers', 'X-CSRF-Token');
                    }
                    else {
                        return response(['message' => 'You are not authorized to use the system', 'errors' => 1], 200);
                    }

                }
                else {
                    return response(['message' => 'Unable to validate token', 'errors' => 1], 200);
                }

            } 
            else {
                return response(['message' => 'Requires token for authentication', 'errors' => 1], 200);
            }

        }
        else {
            return response(['message' => 'You are not logged into the system', 'errors' => 1], 200);
        }

    }
}
