<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    use RegistersUsers;

    public function __construct()
    {
        $this->middleware('auth')->only(['step2Form', 'completeProfile']);
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:20'],
            'bin' => ['required', 'string', 'max:12'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'email' => $data['email'],
            'phone' => $data['phone'],
            'bin' => $data['bin'],
            'password' => Hash::make($data['password']),
            'firstName' => '', // empty placeholder
            'lastName' => '',
            'businessName' => '',
        ]);

        Auth::login($user); // auto login
        return $user;
    }

    // After register, go to step 2
    protected function registered(Request $request, $user)
    {
        return redirect()->route('register.step2.form');
    }

    public function step2Form()
    {
        return view('auth.signup_info1');
    }

    public function completeProfile(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'business_name' => 'required|string|max:255',
        ]);

        $user = Auth::user();

        $user->update([
            'firstName' => $request->first_name,
            'lastName' => $request->last_name,
            'businessName' => $request->business_name,
        ]);

        return redirect('/home')->with('success', 'Profile completed successfully!');
    }
}
