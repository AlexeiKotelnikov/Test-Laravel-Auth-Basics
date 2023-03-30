<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        $user = $request->user();
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password == $request->password_confirmation) {
            $user->password = Hash::make($request->password);
        }

        $user->update();
        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
