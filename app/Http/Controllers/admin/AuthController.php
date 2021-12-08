<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(){
        $this->middleware(function($request,$next)
        {
            if(Auth::check())
                return redirect()->route('adminDashboard.index');
            return $next($request);
        })->except('logout');
    }

    public function login()
    {
        return view('admin.login');
    }

    public function adminLogin(AdminLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = user();
            if($user->role == 1 )
                return redirect()->route('adminDashboard.index');
            Auth::logout();
        }
        return redirect()->back()->with('error', 'Wrong Credantials');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('userAuth.index');
    }
}
