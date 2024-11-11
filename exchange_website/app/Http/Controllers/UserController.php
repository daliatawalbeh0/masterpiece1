<?php

namespace App\Http\Controllers;

use App\Models\TheUser;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = TheUser::withCount([
            'items as exchange_ads_count' => function ($query) {
                $query->where('status', 'approved');
            },
            'items as donation_ads_count' => function ($query) {
                $query->where('status', 'approved');
            }
        ])->get();

        return view('admindashboard.users.index', compact('users'));
    }

    public function create()
    {
        return view('admindashboard.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:theusers',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'role_id' => 'required|integer',
        ]);

        TheUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('admindashboard.users.index')->with('success', 'User created successfully.');
    }

    public function show($id)
    {
        $user = TheUser::findOrFail($id);
        return view('admindashboard.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = TheUser::findOrFail($id);
        return view('admindashboard.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:theusers,email,' . $id,
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        $user = TheUser::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('admindashboard.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = TheUser::findOrFail($id);
        $user->delete();

        return redirect()->route('admindashboard.users.index')->with('success', 'User deleted successfully.');
    }
}
