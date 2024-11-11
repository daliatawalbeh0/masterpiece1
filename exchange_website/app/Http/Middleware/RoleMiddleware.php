<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (Auth::check()) {
            // إذا كان المستخدم ليس له الدور المطلوب، يعاد توجيهه إلى الصفحة المناسبة
            if (Auth::user()->role_id != $role) {
                return redirect('home'); // أو أي مسار آخر بناءً على الدور
            }
        }

        return $next($request);
    }
}
