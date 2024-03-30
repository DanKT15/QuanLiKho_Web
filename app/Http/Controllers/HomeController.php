<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function handle() {

        if (!Auth::user()) {
            return redirect()->route('login');
        }
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        if (Auth::user()->role === 'user') {
            return redirect()->route('user.dashboard');
        }
        
    }
}
