<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Exchange;

use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Subcategory;
use Carbon\Carbon;

class ExchangeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $exchangeItems = Item::where('status', 'approved')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // التحقق مما إذا كان المستخدم هو المدير
        // $donationItems = [];
        // if (auth()->user() && auth()->user()->role == 'admin') {
        //     // جلب العناصر الخاصة بالتبرع فقط إذا كان المستخدم مديرا
        //     $donationItems = Item::where('status', 'approved')
        //         ->where('transaction_type', 'donate')
        //         ->take(3)
        //         ->get();
        // }
        $suggestedItems = Item::where('status', 'approved')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $categories = Category::all();

        return view('home', compact('exchangeItems', 'categories', 'suggestedItems'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();

        return view('postad', compact('categories', 'subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to post an ad.');
        }

        $validatedData = $request->validate([
            'subcategory_id' => 'required|integer',
            'category_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'condition' => 'required|string|max:50',
            'usage_duration' => 'required|string|max:50',
            'images' => 'required|array|size:3', // Ensures exactly 3 images are uploaded
            'images.*' => 'image|max:10240', // Each image max size 10 MB
            'status' => 'required|string|max:50',
            'is_exchange_specific' => 'required|boolean',
            'desired_item_id' => 'nullable|integer',
            'desired_item_category' => 'nullable|integer',
            'desired_item_subcategory' => 'nullable|integer',
            'desired_item_description' => 'nullable|string',
            'show' => 'required|boolean',
        ]);

        // Store images and save paths in JSON format
        $imagePaths = [];
        foreach ($request->file('images') as $image) {
            $imagePaths[] = $image->store('images', 'public');
        }

        // Create and save item
        $item = new Item();
        $item->user_id = Auth::id();
        $item->subcategory_id = $validatedData['subcategory_id'];
        $item->category_id = $validatedData['category_id'];
        $item->title = $validatedData['title'];
        $item->description = $validatedData['description'];
        $item->price = $validatedData['price'];
        $item->condition = $validatedData['condition'];
        $item->usage_duration = $validatedData['usage_duration'];
        $item->image = json_encode($imagePaths); // Store images as JSON
        $item->status = $validatedData['status'];
        $item->is_exchange_specific = $validatedData['is_exchange_specific'];
        $item->desired_item_id = $validatedData['desired_item_id'];
        $item->desired_item_category = $validatedData['desired_item_category'];
        $item->desired_item_subcategory = $validatedData['desired_item_subcategory'];
        $item->desired_item_description = $validatedData['desired_item_description'];
        $item->show = $validatedData['show'];

        $item->save();

        return redirect()->route('productSuggestions')->with('success', 'Your ad has been submitted and is pending review.');
    }

    public function edit(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {}
    public function calculateDiscount(Request $request)
    {
        $validatedData = $request->validate([
            'price' => 'required|numeric|min:0',
            'usage_duration' => 'required|integer|min:0'
        ]);

        $originalPrice = $validatedData['price'];
        $usageDuration = $validatedData['usage_duration'];


        $discountPeriods = floor($usageDuration / 6);

        $discount = $discountPeriods * 0.10 * $originalPrice;

        $finalPrice = $originalPrice - $discount;

        $suggestedItems = Item::where('price', '<=', $finalPrice)->get();

        return view('productSuggestions', compact('finalPrice', 'suggestedItems'));
    }

    public function approveDeal($exchange_id)
    {
        $exchange = Exchange::findOrFail($exchange_id);
        $exchange->status = 'approved';
        $exchange->save();

        $expirationDate = Carbon::now()->addDays(3);

        Item::where('user_id', $exchange->sender_id)
            ->orWhere('user_id', $exchange->receiver_id)
            ->update([
                'is_visible' => false,
                'expiration_date' => $expirationDate
            ]);

        return redirect()->back()->with('success', 'Deal approved. Items will be removed in 3 days.');
    }
    public function pendingExchanges()
    {
        $pendingExchanges = Exchange::where('status', 'pending')->with(['user', 'item', 'offeredItem', 'offeredUser'])->get();
        return view('admindashboard.exchanges.pending', compact('pendingExchanges'));
    }
    public function approveExchange($id)
    {
        $exchange = Exchange::findOrFail($id);
        $exchange->status = 'approved';
        $exchange->save();

        return redirect()->route('admindashboard.exchanges.pending')->with('success', 'Exchange approved successfully.');
    }


    public function rejectExchange($id)
    {
        $exchange = Exchange::findOrFail($id);
        $exchange->status = 'rejected';
        $exchange->save();

        return redirect()->route('admindashboard.exchanges.pending')->with('success', 'Exchange rejected successfully.');
    }
    public function approvedExchangesads()
    {
        $approvedExchanges = Item::where('status', 'approved')
            ->get();

        return view('admindashboard.items.approved_exchanges', compact('approvedExchanges'));
    }
    public function approvedDealExchanges()
    {
        $approvedDealExchanges = Exchange::where('status', 'complete')->get();

        return view('admindashboard.exchanges.approved_deals', compact('approvedDealExchanges'));
    }
    public function rejectedDealExchanges()
    {
        $rejectedDealExchanges = Exchange::where('status', 'rejected')->get();

        return view('admindashboard.exchanges.rejected_deals', compact('rejectedDealExchanges'));
    }
    // In ExchangeController
    public function confirmForm($otherUserItemId)
    {
        $userItems = Item::where('user_id', Auth::id())->get();

        $otherUserItem = Item::findOrFail($otherUserItemId);

        return view('deal', compact('userItems', 'otherUserItem'));
    }

    public function storeDeal(Request $request)
    {
        $validatedData = $request->validate([
            'item_id' => 'required|integer|exists:items,id',
            'offered_item_id' => 'required|integer|exists:items,id',
            'additional_info' => 'nullable|string|max:500',
        ]);

        $exchange = new Exchange();
        $exchange->sender_id = Auth::id();
        $exchange->receiver_id = Item::findOrFail($validatedData['offered_item_id'])->user_id; // Find the owner of the offered item
        $exchange->item_id = $validatedData['item_id'];
        $exchange->offered_item_id = $validatedData['offered_item_id'];
        $exchange->status = 'pending';
        $exchange->additional_info = $validatedData['additional_info'];
        $exchange->save();

        return redirect()->route('home')->with('success', 'Deal submitted and is pending admin approval.');
    }
}
