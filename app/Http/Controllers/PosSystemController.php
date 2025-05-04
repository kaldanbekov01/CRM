<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PosSystemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pos_system.index');
    }

    public function select()
    {
        if (Auth::guard('employee')->check()) {
            $user = Auth::guard('employee')->user();
        } else {
            $user = Auth::guard('web')->user();
        }

        $supplierIds = Supplier::where('user_id', $user->id)->pluck('id');

        $products = Product::with('category')
            ->whereIn('supplier_id', $supplierIds)
            ->get();

        $categories = $products->pluck('category')
            ->filter()
            ->unique('id')
            ->values();

        $productsByCategory = $products->groupBy(function ($product) {
            return strtolower(trim(optional($product->category)->name ?? 'uncategorized'));
        });

        return view('pos_system.select', compact('products', 'categories', 'productsByCategory'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function search(Request $request)
    {
        $user = Auth::guard('web')->user();

        $supplierIds = Supplier::where('user_id', $user->id)->pluck('id');

        $products = Product::with(['category', 'supplier'])
            ->whereIn('supplier_id', Supplier::where('user_id', auth()->id())->pluck('id'))
            ->when($request->input('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(10);

        $categories = Product::whereIn('supplier_id', $supplierIds)
            ->with('category')
            ->get()
            ->pluck('category')
            ->unique('id');

        return view('pos_system.select', data: compact('products', 'categories'));

    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {

        return view('pos_system.show');

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
