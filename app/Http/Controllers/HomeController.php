<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Employee;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('multiauth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::guard('employee')->check()) {
            $employee = Auth::guard('employee')->user();

            $orders = Order::with(['employee', 'client', 'basket.product'])
                ->where('employee_id', $employee->id)
                ->orderByDesc('created_at')
                ->get();

            $employeeCount = 1;
        } else {
            $user = Auth::guard('web')->user();

            $employeeIds = Employee::where('user_id', $user->id)->pluck('id');

            $orders = Order::with(['employee', 'client', 'basket.product'])
                ->whereIn('employee_id', $employeeIds)
                ->orderByDesc('created_at')
                ->get();

            $employeeCount = $employeeIds->count();
        }

        $totalSales = $orders->sum('total_amount');
        $totalOrders = $orders->count();

        // Top Selling Products This Week
        $weekStart = Carbon::now()->startOfWeek();
        $topProducts = DB::table('baskets')
            ->join('orders', 'baskets.order_id', '=', 'orders.id')
            ->join('products', 'baskets.product_id', '=', 'products.id')
            ->select('products.name', DB::raw('SUM(baskets.quantity) as total'))
            ->where('orders.created_at', '>=', $weekStart)
            ->groupBy('products.name')
            ->orderByDesc('total')
            ->limit(3)
            ->get();

        $weeklyOrders = Order::select(DB::raw('DAYNAME(created_at) as day'), DB::raw('SUM(total_amount) as total'))
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->groupBy('day')
            ->orderByRaw("FIELD(day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')")
            ->get()
            ->pluck('total', 'day');

        // Sales by category for Pie Chart
        $salesByCategory = DB::table('orders')
            ->join('baskets', 'orders.id', '=', 'baskets.order_id')
            ->join('products', 'baskets.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('categories.name as category', DB::raw('SUM(baskets.quantity * products.retail_price) as total'))
            ->groupBy('categories.name')
            ->get();

        $weeklyOrders = $weeklyOrders->isEmpty() ? collect(['Monday' => 0]) : $weeklyOrders;
        $salesByCategory = $salesByCategory->isEmpty() ? collect([['category' => 'None', 'total' => 0]]) : $salesByCategory;

        return view('home', compact('orders', 'totalSales', 'totalOrders', 'employeeCount', 'topProducts', 'weeklyOrders', 'salesByCategory'));
    }
    public function support()
    {
        return view('support');
    }
}
