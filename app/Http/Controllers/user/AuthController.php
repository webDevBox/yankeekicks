<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UserAuthRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserForgotRequest;
use App\Http\Requests\UserResetRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\YankeekickMail;
use App\Models\User;

class AuthController extends Controller
{

    public function __construct() {
        $this->middleware(function ($request, $next) {
            if(Auth::check())
            {
                if(user()->role == 1 || user()->role == 2)
                    return redirect()->route('adminDashboard.index');
                if(user()->role == 0)
                    return redirect()->route('userDashboard.index');
            }
            return $next($request);
        })->except('logout','verify');;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.auth.register');
    }
    
    public function forgot()
    {
        return view('forgot');
    }
    
    public function changePassword($token)
    {
        $user = User::where('token',$token)->first();
        return view('reset',compact('user'));
    }

    public function userForgot(UserForgotRequest $request)
    {
        $user = User::forgotPassword($request);
        return redirect()->route($user['route'])->with($user['message']);
    }
    
    public function resetPassword(UserResetRequest $request)
    {
        $user = User::resetPassword($request);
        return redirect()->route($user['route'])->with($user['message']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserAuthRequest $request)
    {
        if(!isset($request->role))
            $request->role = 0;
        $user = User::createUser($request);
        return redirect()->route('userAuth.index')->with($user['alert']);
    }
    

    public function login(UserLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = user();
            if($user->status == 0 && ($user->token == null  || $user->token_generation_time != null))
            {
                if($user->role == 1 || $user->role == 2)
                    return redirect()->route('adminDashboard.index');
                    
                if($user->role == 0)
                    return redirect()->route('userDashboard.index');
                return redirect()->back()->with('error' , 'Wrong Credantials');
            }  
            Auth::logout();
            return redirect()->back()->with('error' , 'Your Account is Suspended or Not Verified! Contact to Admin');
        }
        return redirect()->back()->with('error', 'Wrong Credantials');
    }

    public function verify($token)
    {
        User::where('token',$token)->update(['token' => null]);
        return redirect()->route('userAuth.index')->with('success','Your Account Verified');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('userAuth.index');
    }
}
