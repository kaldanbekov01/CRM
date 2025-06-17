<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Profiler\Profile;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function update(Request $request, Profile $profile)
    {
        // $validated = $request->validate([
        //     'stock_quantity' => 'required|integer',
        // ]);

        // if ($validated['stock_quantity'] >= -($profile->stock_quantity)) {
        //     $product->stock_quantity += $validated['stock_quantity'];
        //     $product->save();


        //     return redirect()->route('product.index')->with('success', 'Stock quantity updated successfully!');
        // } else
        //     return response()->json(['success' => false, 'message' => 'Less than stock_quantity'], 400);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
