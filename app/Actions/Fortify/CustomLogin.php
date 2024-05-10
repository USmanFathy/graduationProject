<?php

namespace App\Actions\Fortify;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomLogin
{
    public static function login($request, $guard)
    {
        $credentials = $request->only('email', 'password');

        if ($guard === 'admin') {
            $user = Admin::where('email', $credentials['email'])->first();
        } else {
            $user = User::where('email', $credentials['email'])->first();
        }

        if ($user && Hash::check($credentials['password'], $user->password)) {
            return $user; // Return the authenticated user object
        }

        return null;
    }}
