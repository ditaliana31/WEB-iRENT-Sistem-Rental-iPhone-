<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // HALAMAN PROFILE
    public function index()
    {
        return view('pages.profile');
    }

    // HALAMAN EDIT
    public function edit()
    {
        return view('pages.edit-profile');
    }

    // UPDATE PROFILE
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|confirmed|min:6',
        ]);

        $user = Auth::user();

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()
            ->route('profile')
            ->with('success', 'Profile berhasil diperbarui');
    }
}
