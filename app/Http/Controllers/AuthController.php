<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function viewLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $user = User::where('username', $request->username)->first();
        if ($user && Hash::check($request->input('password'), $user->password)) {
            Auth::loginUsingId($user->id, TRUE);
            return redirect('/home');
        } else {
            return redirect('/')->withErrors('Username atau Password salah!');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/')->with('success', 'Logout berhasil');
    }
}
