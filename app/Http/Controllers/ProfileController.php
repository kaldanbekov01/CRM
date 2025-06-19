<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile'); 
    }

    public function update(Request $request)
    {
        $user = Auth::guard('web')->user() ?? Auth::guard('employee')->user();

        if (!$user) {
            return redirect()->back()->withErrors('Unauthorized access');
        }

        $validated = $request->validate([
            'email' => 'required|email',
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $user->email = $validated['email'];
        $user->firstName = $validated['firstName'];
        $user->lastName = $validated['lastName'];
        $user->phone = $validated['phone'];
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
