<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // وضع جميع الإشعارات كـ "تمت قراءتها"
    public function markAsRead()
    {
        // تحقق مما إذا كان لدى المستخدم إشعارات غير مقروءة
        if (Auth::user()->unreadNotifications->isNotEmpty()) {
            Auth::user()->unreadNotifications->markAsRead();
            return redirect()->back()->with('success', 'All notifications marked as read.');
        }

        // إذا لم يكن هناك إشعارات غير مقروءة
        return redirect()->back()->with('info', 'No unread notifications.');
    }
    public function markMessagesAsRead()
    {
        // جلب كل الإشعارات من نوع UserMessageNotification فقط
        $notifications = Auth::user()->unreadNotifications->where('type', 'App\Notifications\UserMessageNotification');

        // تحديد كل الإشعارات كمقروءة
        $notifications->markAsRead();

        // إعادة التوجيه للصفحة السابقة بعد التحديد كمقروءة
        return redirect()->back()->with('success', 'All messages marked as read.');
    }
}
