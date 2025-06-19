<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::guard('employee')->check()) {
            $user = Auth::guard('employee')->user();
            $userId = $user->user_id; 
        } else {
            $user = Auth::guard('web')->user();
            $userId = $user->id;
        }

        $supplierIds = Supplier::where('user_id', $userId)->pluck('id');

        $categories = Category::where('user_id', $userId)->get();

        $products = Product::with(['category', 'supplier'])
            ->whereIn('supplier_id', $supplierIds)
            ->when($request->input('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->when($request->input('category'), function ($query, $categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->orderBy('category_id')
            ->get();

        return view('product.index', compact('products', 'categories'));
    }





    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();

        return view('product.create', compact('categories', 'suppliers'));
    }


    /**
     * Store a newly created resource in storage.
     */
    //
    public function store(Request $request)
    {
        $validated = $request->validate([
            'barcode' => 'nullable|string|max:255',
            'wholesale_price' => 'required|numeric|min:0',
            'retail_price' => 'required|numeric|min:0',
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'stock_quantity' => 'required|integer|min:1',
        ]);

        Product::create([
            'barcode' => $validated['barcode'],
            'wholesale_price' => $validated['wholesale_price'],
            'retail_price' => $validated['retail_price'],
            'name' => $validated['name'],
            'category_id' => $validated['category_id'],
            'supplier_id' => $validated['supplier_id'],
            'stock_quantity' => $validated['stock_quantity'],
        ]);

        return redirect()->route('product.index')->with('success', 'Product added successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'stock_quantity' => 'required|integer',
        ]);

        if ($validated['stock_quantity'] >= -($product->stock_quantity)) {
            $product->stock_quantity += $validated['stock_quantity'];
            $product->save();


            return redirect()->route('product.index')->with('success', 'Stock quantity updated successfully!');
        }
        else return response()->json(['success' => false, 'message' => 'Less than stock_quantity'], 400);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product deleted successfully!');
    }


}
