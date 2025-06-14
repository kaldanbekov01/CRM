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
        $weekStart = Carbon::now()->startOfWeek();
        $weekEnd = Carbon::now()->endOfWeek();

        if (Auth::guard('employee')->check()) {
            $employee = Auth::guard('employee')->user();
            $userId = $employee->user_id;
            $employeeId = $employee->id;
            $isEmployee = true;

            // Заказы только этого сотрудника
            $orders = Order::with(['employee', 'client', 'basket.product'])
                ->where('employee_id', $employeeId)
                ->orderByDesc('created_at')
                ->get();

            $employeeCount = 1;
        } else {
            $user = Auth::guard('web')->user();
            $userId = $user->id;
            $employeeId = null;
            $isEmployee = false;

            // Все заказы всех сотрудников пользователя
            $employeeIds = Employee::where('user_id', $userId)->pluck('id');

            $orders = Order::with(['employee', 'client', 'basket.product'])
                ->whereIn('employee_id', $employeeIds)
                ->orderByDesc('created_at')
                ->get();

            $employeeCount = $employeeIds->count();
        }

        $totalSales = $orders->sum('total_amount');
        $totalOrders = $orders->count();

        // Top Products
        $topProductsQuery = DB::table('baskets')
            ->join('orders', 'baskets.order_id', '=', 'orders.id')
            ->join('products', 'baskets.product_id', '=', 'products.id')
            ->join('suppliers', 'products.supplier_id', '=', 'suppliers.id')
            ->select('products.name as product', DB::raw('SUM(baskets.quantity) as quantity'))
            ->where('orders.created_at', '>=', $weekStart)
            ->where('suppliers.user_id', $userId);

        if ($isEmployee) {
            $topProductsQuery->where('orders.employee_id', $employeeId);
        }

        $topProducts = $topProductsQuery
            ->groupBy('products.name')
            ->orderByDesc('quantity')
            ->limit(3)
            ->get();

        // Weekly Orders
        $weeklyOrdersQuery = DB::table('orders')
            ->join('baskets', 'orders.id', '=', 'baskets.order_id')
            ->join('products', 'baskets.product_id', '=', 'products.id')
            ->join('suppliers', 'products.supplier_id', '=', 'suppliers.id')
            ->select(DB::raw('DAYNAME(orders.created_at) as day'), DB::raw('SUM(orders.total_amount) as total'))
            ->whereBetween('orders.created_at', [$weekStart, $weekEnd])
            ->where('suppliers.user_id', $userId);

        if ($isEmployee) {
            $weeklyOrdersQuery->where('orders.employee_id', $employeeId);
        }

        $weeklyOrders = $weeklyOrdersQuery
            ->groupBy('day')
            ->orderByRaw("FIELD(day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')")
            ->get()
            ->pluck('total', 'day');

        // Sales by Category
        $salesByCategoryQuery = DB::table('orders')
            ->join('baskets', 'orders.id', '=', 'baskets.order_id')
            ->join('products', 'baskets.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('suppliers', 'products.supplier_id', '=', 'suppliers.id')
            ->select('categories.name as category', DB::raw('SUM(baskets.quantity * products.retail_price) as total'))
            ->where('suppliers.user_id', $userId);

        if ($isEmployee) {
            $salesByCategoryQuery->where('orders.employee_id', $employeeId);
        }

        $salesByCategory = $salesByCategoryQuery
            ->groupBy('categories.name')
            ->get();

        // Защита от пустых графиков
        $weeklyOrders = $weeklyOrders->isEmpty() ? collect(['Monday' => 0]) : $weeklyOrders;
        $salesByCategory = $salesByCategory->isEmpty() ? collect([['category' => 'None', 'total' => 0]]) : $salesByCategory;
        $topProducts = $topProducts->isEmpty() ? collect([['product' => 'None', 'quantity' => 0]]) : $topProducts;

        return view('home', compact(
            'orders',
            'totalSales',
            'totalOrders',
            'employeeCount',
            'topProducts',
            'weeklyOrders',
            'salesByCategory'
        ));
    }

    public function support()
    {
        return view('support');
    }
}
