<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Basket;
use App\Models\Client;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        if (Auth::guard('employee')->check()) {
            $employee = Auth::guard('employee')->user();
    
            // Показываем только заказы этого сотрудника
            $orders = Order::with(['employee', 'client'])
                        ->where('employee_id', $employee->id)
                        ->orderByDesc('created_at')
                        ->paginate(10);
        } else {
            $user = Auth::guard('web')->user();
    
            // Показываем все заказы, связанные с клиентами, принадлежащими этому пользователю
            $clientIds = Client::where('user_id', $user->id)->pluck('id');
    
            $orders = Order::with(['employee', 'client'])
                        ->whereIn('client_id', $clientIds)
                        ->orderByDesc('created_at')
                        ->paginate(10);
        }
    
        return view('order.index', compact('orders'));
    }
    /**
     * Store a newly created order in the database.
     */
    public function store(Request $request)
    {}


    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        
    }
}
