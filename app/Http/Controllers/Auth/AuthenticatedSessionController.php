<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Nhansu;
use Illuminate\Support\Facades\DB;

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

    public function storeAPI(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        $token = csrf_token();

        return response(['message' => 'Login successfully', 'token' => $token, 'errors' => 0], 200);
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

        $idnhanvien = Auth::id();
        $nhanvien =  Nhansu::firstWhere('MANV', $idnhanvien);
        $token = csrf_token();

        return response(['message' => 'Retrieved successfully', 'errors' => 0, 'token' => $token, 'id user' => $idnhanvien, 'info user' => $nhanvien], 200);
    }
}
