<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use Illuminate\Support\Facades\Auth;

class UserDonationController extends Controller
{
    // عرض صفحة إضافة إعلان التبرع
    public function create()
    {
        return view('create_donation');
    }

    // تخزين إعلان التبرع الجديد في قاعدة البيانات
    public function store(Request $request)
    {
        // التحقق من صحة البيانات المدخلة
        $request->validate([
            'item_title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // صورة بحجم أقصى 2MB
        ]);

        // رفع الصورة
        $imagePath = $request->file('image')->store('images', 'public');

        // إنشاء إعلان التبرع
        $donation = new Donation();
        $donation->item_title = $request->input('item_title');
        $donation->description = $request->input('description');
        $donation->image = $imagePath;
        $donation->status = 'pending'; // سيكون الإعلان في حالة انتظار موافقة الأدمن
        $donation->donor_id = Auth::id(); // ربط الإعلان بالمستخدم الذي أضافه
        $donation->save();

        return redirect()->back()->with('success', 'Your donation ad has been posted and is awaiting approval.');
    }
}
