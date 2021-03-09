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
        if ($user != null) {
            if (Hash::check($request->input('password'), $user->password)) {
                Auth::loginUsingId($user->id, TRUE);
                return redirect('/home');
            }
            return redirect('/')->withErrors('Username atau Password salah!');
        }
        return redirect('/')->withErrors('Username tidak ada di database');
    }

    public function viewRegister()
    {
        return view('auth.register');
    }

    public function register(CreateUserRequest $request)
    {
        $request->validated();

        $data = [
            'username' => $request->username,
            'password' => bcrypt($request->password)
        ];

        User::create($data);

        return redirect('/')->with('success', 'Berhasil membuat akun baru');
    }

    public function home()
    {
        return view('dashboard.index');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/')->with('success', 'Logout berhasil');
    }
}
