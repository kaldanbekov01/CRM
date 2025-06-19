<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Financial;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class FinancialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::guard('web')->user();
        if (!$user) {
            abort(403, 'Unauthorized');
        }

        $today = Carbon::today()->toDateString();

        $products = Product::whereIn('supplier_id', function ($query) use ($user) {
            $query->select('id')
                ->from('suppliers')
                ->where('user_id', $user->id);
        })->get();

        $income = $products->sum(function ($product) {
            return $product->stock_quantity * ($product->retail_price - $product->wholesale_price);
        });

        $expense = $products->sum(function ($product) {
            return $product->stock_quantity * $product->wholesale_price;
        });

        $financial = Financial::firstOrNew(
            ['user_id' => $user->id, 'date' => $today],
            ['income' => 0, 'expense' => 0]
        );

        $financial->income = $income + $expense;
        $financial->expense = $expense;
        $financial->save();
        $financials = Financial::orderBy('date')->get();

        $monthlyIncome = [];
        $monthlyExpenses = [];
        $monthlySavings = [];

        foreach (range(1, 12) as $month) {
            $start = now()->startOfYear()->addMonths($month - 1);
            $end = now()->startOfYear()->addMonths($month)->subDay();
        
            $monthly = $financials->whereBetween('date', [$start, $end]);
        
            $income = $monthly->sum('income');
            $expenses = $monthly->sum('expense');
        
            $monthlyIncome[] = $income;
            $monthlyExpenses[] = $expenses;
            $monthlySavings[] = $income - $expenses;
        }
        

        return view('financial.index', compact('financials', 'monthlyIncome', 'monthlyExpenses', 'monthlySavings'));
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
        //
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
