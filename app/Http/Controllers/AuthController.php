<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UpdateRegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public static function store($email)
    {
        if (!User::where('email', $email)->exists()) {
            User::create(['email' => $email]);
        }
    }

    public function registerPage($email)
    {
        if (!User::where('email', $email)->exists()) {
            return redirect()->route('auth.register-email-page');
        }

        if (User::where('email', $email)->where('active', true)->exists()) {
            return redirect()->route('auth.login-page');
        }

        $id = User::where('email', $email)->select('id')->first()->id;
        return view('auth.register', compact('email', 'id'))->with('success', 'Email Verified, Continue registration');
    }

    public function update(UpdateRegisterRequest $request, User $user)
    {
        if (!hash_equals($request->validated('email'), $user->email)) {
            return back()->with('error', 'invalid user input');
        }

        $user->update([
            'name' => $request->validated('name'),
            'password' => $request->validated('password'),
            'active' => true
        ]);

        auth()->login($user);
        return redirect()->route('tasks.index')->with('success', 'registration successful, you are now logged in');
    }

    public function login(LoginRequest $request)
    {
        $this->verifyCaptcha($request->input('g-recaptcha-response'));

        if (!Auth::attempt($request->validated())) {
            return back()->with('error', 'invalid credentials');
        }

        return redirect()->route('tasks.index');
    }

    public function logout()
    {
        Auth::logout();
        session()->regenerate();
        return redirect()->route('auth.login-page')->with('success', 'logged out');
    }
}
