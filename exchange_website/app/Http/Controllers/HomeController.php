<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // This method will be used to return the home page view
    public function index()
    {
        // Pass any data to the view if necessary (you can add arrays or collections here)
        return view('home'); // تم تعديل المسار ليشير مباشرة إلى الملف في views
    }
    public function showNotifications()
    {
        // جلب المستخدم الحالي
        $user = Auth::TheUser();

        // جلب جميع الإشعارات للمستخدم الحالي
        $notifications = $user->notifications;

        // تمرير الإشعارات إلى العرض
        return view('notifications', compact('notifications'));
    }
}
