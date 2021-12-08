<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests\UserProfileRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminProfileController extends Controller
{
    public function index()
    {
        $user = user();
        return view('admin.profile', compact('user'));
    }

    public function update(UserProfileRequest $request)
    {
        $user = User::updateProfile($request);
        return redirect()->back()->with($user);
    }
}
