<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\TheUser;
use App\Models\Exchange;
use Carbon\Carbon;
use App\Notifications\AdStatusNotification;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{


    public function updateItemStatus(Request $request, $itemId)
    {
        // العثور على العنصر بواسطة ID
        $item = Item::find($itemId);

        // تحديث حالة العنصر (approved أو rejected)
        $item->status = $request->input('status');
        $item->save();

        // إرسال إشعار للمستخدم الذي يملك العنصر
        $user = $item->user; // افتراضًا أن العنصر مرتبط بالمستخدم
        $status = $item->status; // حالة العنصر (approved أو rejected)
        $itemTitle = $item->title;

        // إرسال الإشعار
        $user->notify(new AdStatusNotification($status, $itemTitle));

        return back()->with('success', 'Item status updated and notification sent.');
    }


    public function index()
    {
        // الحصول على عدد المستخدمين الجدد خلال آخر 30 يوم
        $newUsersCount = TheUser::where('created_at', '>=', Carbon::now()->subDays(30))->count();
        $pendingItemsCount = Item::where('status', 'Pending')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->count();
        $approvedExchangeItemsCount = Item::where('status', 'approved')
            ->count();
        $approvedDonationsCount = Item::where('status', 'approved')
            ->count();

        $completedExchangesByMonth = Exchange::where('status', 'completed') // assuming 'completed' is a valid status
            ->whereYear('created_at', Carbon::now()->year)
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('count', 'month')
            ->toArray();

        // الأشهر
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        // تكملة عدد الأشهر التي لا يوجد بها بيانات
        $exchangeCounts = [];
        foreach (range(1, 12) as $month) {
            $exchangeCounts[] = $completedExchangesByMonth[$month] ?? 0;
        }

        return view('admindashboard.index', compact('newUsersCount', 'pendingItemsCount', 'approvedExchangeItemsCount', 'approvedDonationsCount', 'months', 'completedExchangesByMonth', 'exchangeCounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editProfile()
    {
        // جلب بيانات المستخدم الذي تم تسجيل الدخول به (الأدمن)
        $admin = auth()->guard('web')->user();

        // عرض صفحة التعديل مع البيانات
        return view('admindashboard.profile.edit', compact('admin'));
    }

    // public function updateProfile(Request $request)
    // {
    //     // التحقق من البيانات
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255',
    //         'password' => 'nullable|string|min:8|confirmed', // كلمة المرور اختيارية
    //     ]);

    //     // جلب بيانات الأدمن
    //     $admin = auth()->user();
    //     dd($admin); // تحقق إذا كانت بيانات الأدمن صحيحة


    //     // تحديث البيانات
    //     $admin->name = $request->name;
    //     $admin->email = $request->email;

    //     // تحقق من كلمة المرور
    //     if ($request->filled('password')) {
    //         $admin->password = bcrypt($request->password);
    //     }

    //     $admin->save(); // يجب أن يعمل هذا

    //     // إعادة توجيه مع رسالة نجاح
    //     return redirect()->route('admindashboard.profile.show')->with('success', 'Profile updated successfully.');
    // }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    // عرض المنتجات التي لم تتم الموافقة عليها بعد
    public function pendingItems()
    {
        $items = Item::where('status', 'pending')->get();
        return view('admin.items.pending', compact('items'));
    }

    // الموافقة على منتج معين
    public function approveItem($id)
    {
        $item = Item::findOrFail($id);
        $item->status = 'approved';
        $item->save();

        return redirect()->route('admin.pendingItems')->with('success', 'Item approved successfully!');
    }
    // public function showDataTables()
    // {
    //     // جلب المستخدمين
    //     $users = TheUser::withCount([
    //         'items as exchange_ads_count' => function ($query) {
    //             $query->where('transaction_type', 'exchange')->where('status', 'approved');
    //         },
    //         'items as donation_ads_count' => function ($query) {
    //             $query->where('transaction_type', 'donate')->where('status', 'approved');
    //         }
    //     ])->get();

    //     // تمرير البيانات إلى العرض
    //     return view('admindashboard.userstable', compact('users'));
    // }
    public function showProfile()
    {

        $admin = auth()->guard('web')->user();

        return view('admindashboard.profile.show', compact('admin'));
    }
}
