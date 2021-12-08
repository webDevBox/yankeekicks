<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserProfileRequest;

class UserProfileController extends Controller
{
    public function index()
    {
        $user = user();
        return view('user.profile', compact('user'));
    }

    public function update(UserProfileRequest $request)
    {
        $user = User::updateProfile($request);
        return redirect()->back()->with($user);
    }
}
