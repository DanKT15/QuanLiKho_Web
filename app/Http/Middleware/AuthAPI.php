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

            $header = $request->header("Authorization");
            $token = csrf_token();

            if (!empty($token)) {
                if (!empty($header)) {

                    if ($header === $token) {
                        return $next($request);
                    }
                    else {
                        return response(['message' => 'Unable to validate token', 'errors' => 1], 200);
                    }
    
                } 
                else {
                    return response(['message' => 'Requires header for authentication', 'errors' => 1], 200);
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
