<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::guard('employee')->check()) {
            $user = Auth::guard('employee')->user();
            $userId = $user->user_id; 
        } else {
            $user = Auth::guard('web')->user();
            $userId = $user->id;
        }

        $clients = Client::where("user_id", $userId)->get();;

        return view('client.index', compact('clients'));
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
        if (Auth::guard('employee')->check()) {
            $user = Auth::guard('employee')->user();
            $userId = $user->user_id;
        } else {
            $user = Auth::guard('web')->user();
            $userId = $user->id;
        }
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:12|unique:clients,phone',
        ]);

        Log::info('Simulated client submission:', $validated);
        Client::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'user_id' => $userId,
        ]);

        return redirect()->route('client.index')->with('success', 'Client added successfully');
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
    public function edit(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
