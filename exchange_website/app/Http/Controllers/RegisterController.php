<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TheUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:theusers',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // إنشاء المستخدم الجديد مع role_id افتراضي 2
        $user = TheUser::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'phone_number' => $request->input('phone_number'),
            'address' => $request->input('address'),
            'role_id' => 2, // الدور الافتراضي 2
        ]);

        Auth::login($user); // تسجيل الدخول بعد الإنشاء
        return redirect()->route('login'); // إعادة توجيه المستخدم بعد التسجيل
    }
}
