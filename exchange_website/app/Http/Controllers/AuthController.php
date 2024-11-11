<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TheUser; // أو اسم الموديل الذي تستخدمه
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // عرض صفحة تسجيل الدخول
    public function showLoginForm()
    {
        return view('auth.login'); // تأكد أن صفحة login موجودة
    }

    // عملية تسجيل الدخول
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard'); // أو الصفحة الرئيسية
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // عرض صفحة تسجيل الحساب
    public function showRegisterForm()
    {
        return view('auth.register'); // تأكد أن صفحة register موجودة
    }

    // عملية تسجيل الحساب
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:theusers',
            'password' => 'required|string|min:8|confirmed',
        ]);

        TheUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'role_id' => 2, // افتراضياً، قد ترغب في تعيين دور المستخدم الجديد
        ]);

        return redirect('/login')->with('success', 'Account created successfully. Please login.');
    }

    // عملية تسجيل الخروج
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
