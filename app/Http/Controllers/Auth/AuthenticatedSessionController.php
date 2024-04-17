<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Nhansu;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function storeAPI(Request $request)
    {

        $throttleKey = Str::lower($request->email).'|'.$request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return response(['message' => 'You may try again in '.$seconds.' seconds.', 'errors' => 1], 200);
        }

        if (Auth::check()) {
            return response(['message' => 'The user is logged in...', 'errors' => 1], 200);
        }

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response(['message' => $validator->errors(), 'errors' => 1], 200);
        }

        if(Auth::attempt($request->all())){ 

            $request->session()->regenerate();
            $token = csrf_token();
            RateLimiter::clear($throttleKey);
    
            return response(['message' => 'Login successfully', 'token' => $token, 'errors' => 0], 200);
        } 
        else{ 
            return response(['message' => 'Login failed', 'errors' => 1], 200);
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function destroyAPI(Request $request)
    {
        Auth::guard('api')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response(['message' => 'Logout successfully', 'errors' => 0], 200);
    }

    public function infoAPI() {

        $token = csrf_token();

        if (!empty($token)) {
            return response(['message' => 'Retrieved successfully', 'errors' => 0, 'token' => $token], 200);
        } else {
            return response(['message' => 'token do not exist', 'errors' => 1], 200);
        }
        
    }
}
