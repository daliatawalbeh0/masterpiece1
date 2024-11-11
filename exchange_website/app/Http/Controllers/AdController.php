<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Notifications\AdStatusNotification;

class AdController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $userId = Auth::id();

            $latestItems = Item::where('user_id', $userId)
                ->latest()
                ->take(5)
                ->get();

            $paginatedItems = Item::where('user_id', $userId)
                ->latest()
                ->skip(5)
                ->paginate(5);

            $totalMessages = Message::where('receiver_id', $userId)
                ->count();

            $totalExchangeAds = Item::where('user_id', $userId)
                ->where('status', 'approved') // Only approved exchange ads
                ->count();

            $totalDonationAds = Item::where('user_id', $userId)
                ->where('status', 'approved') // Only approved donation ads
                ->count();

            return view('userdashboard', compact('totalMessages', 'totalExchangeAds', 'totalDonationAds', 'paginatedItems', 'latestItems'));
        } else {
            return redirect()->route('login')->with('error', 'Please login to access your dashboard');
        }
    }



    public function updateAdStatus(Request $request, $itemId)
    {
        // جلب الإعلان المراد تحديثه
        $item = Item::findOrFail($itemId);

        $status = $request->input('status');

        if (!$status) {
            return redirect()->back()->with('error', 'Status is required.');
        }

        $item->status = $status;
        $item->save();

        $user = $item->TheUser; // Assuming the relation is 'TheUser'

        // إعداد الرسالة بناءً على حالة الإعلان
        $statusText = $item->status == 'approved' ? 'approved' : 'rejected';
        $message = "Your ad titled '{$item->title}' has been {$statusText}.";

        $user->notify(new AdStatusNotification($statusText, $item->title));

        return redirect()->back()->with('success', 'Ad status updated and notification sent.');
    }
}
