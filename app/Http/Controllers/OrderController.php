<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Basket;
use App\Models\Client;
use App\Models\Product;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        if (Auth::guard('employee')->check()) {
            $employee = Auth::guard('employee')->user();

            $orders = Order::with(['employee', 'client', 'basket.product'])
                ->where('employee_id', $employee->id)
                ->orderByDesc('created_at')
                ->get();
        } else {
            $user = Auth::guard('web')->user();

            $employeeIds = Employee::where('user_id', $user->id)->pluck('id');

            $orders = Order::with(['employee', 'client', 'basket.product'])
                ->whereIn('employee_id', $employeeIds)
                ->orderByDesc('created_at')
                ->get();
        }

        $dailySales = Order::selectRaw('DATE(created_at) as date, SUM(total_amount) as total')
            ->when(isset($employee), fn($q) => $q->where('employee_id', $employee->id))
            ->when(isset($user), fn($q) => $q->whereIn('employee_id', $employeeIds))
            ->where('created_at', '>=', now()->subDays(6))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $labels = [];
        $totals = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $labels[] = now()->subDays($i)->format('D');
            $day = $dailySales->firstWhere('date', $date);
            $totals[] = $day ? (int) $day->total : 0;
        }

        $ordersWithProducts = $orders->map(function ($order) {
            return [
                'order_id' => $order->id,
                'date' => $order->created_at,
                'payment_method' => $order->payment_method,
                'employee_name' => optional($order->employee)->username,
                'products' => $order->basket->map(function ($item) {
                    return [
                        'name' => $item->product->name ?? 'Unknown',
                        'quantity' => $item->quantity,
                        'price' => $item->product->retail_price ?? 0,
                    ];
                })->toArray(),
                'total_amount' => $order->total_amount,
                'created_at' => $order->created_at->format('Y-m-d H:i'),
            ];
        });

        $week1Total = Order::when(isset($employee), fn($q) => $q->where('employee_id', $employee->id))
            ->when(isset($user), fn($q) => $q->whereIn('employee_id', $employeeIds))
            ->whereBetween('created_at', [now()->subDays(6)->startOfDay(), now()->endOfDay()])
            ->sum('total_amount');

        $week2Total = Order::when(isset($employee), fn($q) => $q->where('employee_id', $employee->id))
            ->when(isset($user), fn($q) => $q->whereIn('employee_id', $employeeIds))
            ->whereBetween('created_at', [now()->subDays(13)->startOfDay(), now()->subDays(7)->endOfDay()])
            ->sum('total_amount');

        if ($week2Total == 0) {
            $percentageChange = $week1Total > 0 ? 100 : 0;
        } else {
            $percentageChange = (($week1Total - $week2Total) / $week2Total) * 100;
        }

        $percentageChange = round($percentageChange, 1); 


        return view('order.index', [
            'orders' => $ordersWithProducts,
            'chartLabels' => $labels,
            'chartTotals' => $totals,
            'percentageChange' => $percentageChange
        ]);
    }


    /**
     * Store a newly created order in the database.
     */
    public function store(Request $request)
    {
    }


    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {

    }
}
