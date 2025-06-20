<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\Basket;
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
            $userId = $user->user_id;
        } else {
            $user = Auth::guard('web')->user();
            $userId = $user->id;
        }

        $supplierIds = Supplier::where('user_id', $userId)->pluck('id');

        $categories = Category::where('user_id', $userId)->get();

        $products = Product::with(['category', 'supplier'])
            ->whereIn('supplier_id', $supplierIds)
            ->orderBy('category_id')
            ->get();

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
        if (Auth::guard('employee')->check()) {
            $user = Auth::guard('employee')->user();
        } else {
            $user = Auth::guard('web')->user();
        }
    
        $supplierIds = Supplier::where('user_id', $user->id)->pluck('id');
    
        $query = Product::with('category')
            ->whereIn('supplier_id', $supplierIds);
    
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhereHas('category', function ($q2) use ($search) {
                      $q2->where('name', 'like', "%{$search}%");
                  });
            });
        }
    
        $products = $query->get();
    
        $categories = $products->pluck('category')
            ->filter()
            ->unique('id')
            ->values();
    
        $productsByCategory = $products->groupBy(function ($product) {
            return strtolower(trim(optional($product->category)->name ?? 'uncategorized'));
        });
    
        return view('pos_system.select', compact('products', 'categories', 'productsByCategory'));
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


    public function checkout(Request $request)
    {
        \Log::info('Checkout started', ['data' => $request->all()]);

        if (!Auth::guard('employee')->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Only employees can perform checkout'
            ], 403);
        }

        $employee = Auth::guard('employee')->user();
        $user = $employee->user ?? null; 

        $cart = $request->input('cart');
        $totalAmount = $request->input('total_amount');
        $paymentMethod = $request->input('payment_method');

        if (!$cart || !$totalAmount || !$paymentMethod) {
            return response()->json(['success' => false, 'message' => 'Missing data.'], 400);
        }

        $client = Client::where('user_id', $employee->user_id)->first(); 

        $order = Order::create([
            'total_amount' => $totalAmount,
            'payment_method' => $paymentMethod,
            'client_id' => $client?->id,
            'employee_id' => $employee->id,
        ]);


        foreach ($cart as $item) {
            if (!isset($item['id']) || !isset($item['quantity'])) {
                \Log::error('Invalid cart item:', $item);
                continue;
            }
        
            Basket::create([
                'quantity' => $item['quantity'],
                'product_id' => $item['id'],
                'order_id' => $order->id,
            ]);
        
            $product = Product::find($item['id']);
            if ($product) {
                $product->stock_quantity = max(0, $product->stock_quantity - $item['quantity']); // не уйдёт в минус
                $product->save();
            } else {
                \Log::warning('Product not found while updating stock', ['product_id' => $item['id']]);
            }
        }
        

        return response()->json(['success' => true, 'message' => 'Order placed successfully']);

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
