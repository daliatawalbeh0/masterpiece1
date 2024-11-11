<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Exchange; // نموذج الصفقة
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DealController extends Controller
{

    // public function confirmDeal(Request $request, $otherUserId)
    // {
    //     // Find items to be exchanged
    //     $item = Item::findOrFail($request->input('item_id'));
    //     $offeredItem = Item::findOrFail($request->input('offered_item_id'));

    //     // Check if authenticated user owns the item
    //     if (Auth::id() !== $item->user_id) {
    //         return redirect()->back()->with('error', 'You are not authorized to confirm this deal.');
    //     }

    //     // Verify if offered item belongs to the other user
    //     if ($offeredItem->user_id != $otherUserId) {
    //         return redirect()->back()->with('error', 'The offered item does not belong to the other user.');
    //     }

    //     // Check item availability
    //     if ($item->status != 'available' || $offeredItem->status != 'available') {
    //         return redirect()->back()->with('error', 'One or both items are not available for exchange.');
    //     }

    //     // Create exchange record
    //     $exchange = Exchange::create([
    //         'user_id' => Auth::id(),
    //         'item_id' => $item->id,
    //         'offered_item_id' => $offeredItem->id,
    //         'offered_user_id' => $otherUserId,
    //         'status' => 'pending',
    //         'created_at' => Carbon::now(),
    //         'updated_at' => Carbon::now(),
    //     ]);

    //     // Update item statuses
    //     $item->status = 'pending_exchange';
    //     $item->save();

    //     $offeredItem->status = 'pending_exchange';
    //     $offeredItem->save();

    //     return redirect()->back()->with('success', 'Deal confirmed and pending admin approval.');
    // }
}
