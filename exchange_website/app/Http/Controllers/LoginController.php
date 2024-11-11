<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // دالة لعرض صفحة تسجيل الدخول
    public function showLoginForm()
    {
        return view('auth.login'); // تأكد أن صفحة login موجودة في مسار resources/views/auth/login.blade.php
    }

    public function login(Request $request)
    {
        // التحقق من صحة بيانات الدخول
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // محاولة تسجيل الدخول
        if (Auth::attempt($credentials)) {
            // إذا كانت البيانات صحيحة، سيتم إعادة توجيه المستخدم
            $request->session()->regenerate();
            return redirect()->intended('home');
        }

        // إذا كانت بيانات الدخول غير صحيحة
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout(); // تسجيل خروج المستخدم
        $request->session()->invalidate(); // إبطال الجلسة الحالية
        $request->session()->regenerateToken(); // إعادة توليد التوكن للجلسة الجديدة

        return redirect('/login'); // إعادة التوجيه إلى صفحة تسجيل الدخول
    }

    /**
     * Redirect users after login based on their role.
     */
    protected function authenticated(Request $request, $user)
    {
        // Check user role and redirect accordingly
        if ($user->role_id == 1) {
            return redirect('/home'); // Admin dashboard
        } elseif ($user->role_id == 2) {
            return redirect('/admin/dashboard'); // Regular user home
        }

        // If no role matches, redirect to a default route
        return redirect('/home');
    }
}
