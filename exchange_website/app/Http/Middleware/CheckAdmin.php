<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // التحقق من إذا كان المستخدم لديه دور "admin"
        if (Auth::check() && Auth::user()->role && Auth::user()->role->name == 'admin') {
            return $next($request);  // السماح بالوصول إذا كان الدور "admin"
        }

        // إذا لم يكن المستخدم "admin"، يتم إعادة توجيهه إلى الصفحة الرئيسية
        return redirect('/home');
    }
}
