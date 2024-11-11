<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Notifications\AdStatusNotification;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $items = Item::paginate(10); // Add pagination
    //     return view('items.index', compact('items'));
    // }

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
    public function show($id)
    {
        $item = Item::findOrFail($id);
        return view('items.show', compact('item'));
    }

    public function showItemDetails($id)
    {
        $item = Item::with('theuser')->findOrFail($id);
        return view('itemdetails', compact('item'));
    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $subcategories = Subcategory::all();
        return view('items.edit', compact('item', 'subcategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect()->route('userdashboard')->with('success', 'Item deleted successfully');
    }
    public function showProductSuggestions(Request $request)
    {
        // الحسابات ومعالجة الخصم
        $originalPrice = $request->input('price');
        $usageDuration = $request->input('usage_duration');
        // dd($originalPrice);
        // حساب الخصم بناءً على مدة الاستخدام
        $discountedPrice = $originalPrice * (1 - (0.10 * floor($usageDuration / 6)));

        // جلب المنتجات المقترحة بناءً على السعر بعد الخصم مع الباجينيشن
        $suggestedItems = Item::where('price', '<=', $discountedPrice)
            ->where('status', 'approved')
            ->paginate(6);  // سيتم عرض 6 منتجات في كل صفحة

        // إعادة العرض مع عرض الاقتراحات والباجينيشن
        return view('productSuggestions', compact('suggestedItems', 'discountedPrice'));
    }


    public function updateAdStatus(Request $request, $itemId)
    {
        // جلب العنصر (الإعلان) بناءً على معرفه
        $item = Item::find($itemId);

        // تحديث حالة العنصر (approved, rejected)
        $item->status = $request->input('status');
        $item->save();

        // إرسال إشعار للمستخدم الذي يملك العنصر
        $user = $item->TheUser; // افتراضًا أن العنصر مرتبط بالمستخدم من خلال علاقة TheUser
        $status = $item->status == 'approved' ? 'approved' : 'rejected';
        $user->notify(new AdStatusNotification($status, $item->title));

        return back()->with('success', 'Item status updated and notification sent.');
    }


    public function pendingExchanges()
    {
        // جلب العناصر التي نوع المعاملة لها "تبادل" وحالتها "قيد الانتظار"
        $pendingExchanges = Item::where('status', 'pending')
            ->get();

        return view('admindashboard.items.pending_exchanges', compact('pendingExchanges'));
    }

    public function approveExchange($id)
    {
        $item = Item::findOrFail($id);
        $item->status = 'approved'; // تحديث الحالة إلى "active" (موافق عليه)
        $item->show = 'active'; // السماح بعرض العنصر في الموقع
        $item->save();

        return redirect()->route('admindashboard.items.pending_exchanges')->with('success', 'Exchange approved successfully.');
    }

    public function rejectExchange($id)
    {
        $item = Item::findOrFail($id);
        $item->status = 'rejected'; // تحديث الحالة إلى "inactive" (مرفوض)
        $item->show = 'inactive'; // عدم عرض العنصر في الموقع
        $item->save();

        return redirect()->route('admindashboard.items.pending_exchanges')->with('success', 'Exchange rejected successfully.');
    }
}
