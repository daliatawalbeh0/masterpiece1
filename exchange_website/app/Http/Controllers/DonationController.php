<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Item;
use App\Models\TheUser;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function pendingDonations()
    {
        $pendingDonations = Item::where('status', 'pending')
            ->get();

        return view('admindashboard.items.pending_donations', compact('pendingDonations'));
    }

    public function approveDonation($id)
    {
        $item = Item::findOrFail($id);
        $item->status = 'approved';
        $item->save();

        Donation::create([
            'item_id' => $item->id,
            'donor_id' => $item->user_id,
            'status' => 'approved',
        ]);

        return redirect()->route('admindashboard.items.pending_donations')->with('success', 'Donation approved successfully.');
    }

    public function rejectDonation($id)
    {
        $item = Item::findOrFail($id);
        $item->status = 'rejected';
        $item->save();

        Donation::create([
            'item_id' => $item->id,
            'donor_id' => $item->user_id,
            'status' => 'rejected',
        ]);

        return redirect()->route('admindashboard.items.pending_donations')->with('success', 'Donation rejected successfully.');
    }

    public function showitems($id)
    {
        $item = Item::with('theuser', 'subcategory')->findOrFail($id);

        return view('admindashboard.items.show', compact('item'));
    }
    public function ShowapprovedDonations()
    {
        $approvedDonations = Donation::where('status', 'approved')
            ->with(['donor', 'item'])
            ->get();

        return view('admindashboard.items.approved_donations', compact('approvedDonations'));
    }
    public function index()
    {
        $approvedDonations = Donation::where('status', 'approved')->with('donor', 'item')->get();
        return view('admindashboard.items.approved_donations', compact('approvedDonations'));
    }


    // public function create()
    // {
    //     $users = TheUser::all();
    //     $items = Item::where('transaction_type', 'donate')->get();
    //     return view('admindashboard.approved_donation.create', compact('users', 'items'));
    // }



    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'donor_id' => 'required|exists:users,id',
            'status' => 'required|string',
        ]);

        Donation::create([
            'item_id' => $request->item_id,
            'donor_id' => $request->donor_id,
            'status' => $request->status,
        ]);

        return redirect()->route('admindashboard.items.approved_donations')->with('success', 'Donation created successfully.');
    }



    // public function edit($id)
    // {
    //     $donation = Donation::findOrFail($id);
    //     $users = TheUser::all();
    //     $items = Item::where('transaction_type', 'donate')->get();
    //     return view('admindashboard.approved_donation.edit', compact('donation', 'users', 'items'));
    // }



    public function update(Request $request, $id)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'donor_id' => 'required|exists:users,id',
            'status' => 'required|string',
        ]);

        $donation = Donation::findOrFail($id);
        $donation->item_id = $request->item_id;
        $donation->donor_id = $request->donor_id;
        $donation->status = $request->status;

        if ($donation->save()) {
            return redirect()->route('admindashboard.items.approved_donations')
                ->with('success', 'Donation updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update donation.');
        }
    }





    public function show($id)
    {
        $donation = Donation::with('donor', 'item')->findOrFail($id);
        return view('admindashboard.approved_donation.show', compact('donation'));
    }



    public function destroy($id)
    {
        $donation = Donation::findOrFail($id);
        $donation->delete();

        return redirect()->route('admindashboard.items.approved_donations')->with('success', 'Donation deleted successfully.');
    }
}
