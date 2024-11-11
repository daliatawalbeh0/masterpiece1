<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\TheUser;
use Illuminate\Support\Facades\Hash;

class TheUsersController extends Controller
{
    public function edit($id)
    {
        $user = TheUser::findOrFail($id);

        return view('userprofilesetting', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = TheUser::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string',
            'city' => 'required|string',
            'password' => 'nullable|min:8|confirmed', // التحقق من كلمة المرور إذا كانت مدخلة
        ]);

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->phone = $validatedData['phone'];
        $user->address = $validatedData['address'];
        $user->city = $validatedData['city'];

        if ($request->filled('password')) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
