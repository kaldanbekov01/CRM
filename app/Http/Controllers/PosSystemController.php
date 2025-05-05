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


    public function checkout(Request $request)
    {
        \Log::info('Checkout started', ['data' => $request->all()]);

        // ✅ Только employee может оформлять заказ
        if (!Auth::guard('employee')->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Only employees can perform checkout'
            ], 403);
        }

        $employee = Auth::guard('employee')->user();
        $user = $employee->user ?? null; // связь с владельцем бизнеса (если есть)

        $cart = $request->input('cart');
        $totalAmount = $request->input('total_amount');
        $paymentMethod = $request->input('payment_method');

        if (!$cart || !$totalAmount || !$paymentMethod) {
            return response()->json(['success' => false, 'message' => 'Missing data.'], 400);
        }

        $client = Client::where('user_id', $employee->user_id)->first(); // или по другой логике

        $order = Order::create([
            'total_amount' => $totalAmount,
            'payment_method' => $paymentMethod,
            'client_id' => $client?->id, // если клиент не найден — будет null
            'employee_id' => $employee->id,
        ]);


        foreach ($cart as $item) {
            if (!isset($item['id']) || !isset($item['quantity'])) {
                \Log::error('Invalid cart item:', $item);
                continue;
            }
        
            // 1. Создать запись в корзине
            Basket::create([
                'quantity' => $item['quantity'],
                'product_id' => $item['id'],
                'order_id' => $order->id,
            ]);
        
            // 2. Уменьшить stock_quantity у продукта
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
