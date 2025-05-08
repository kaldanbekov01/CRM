@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="../css/financials.css">
@endpush

@section('content')
@php
    $user = Auth::guard('web')->user();
    $employee = Auth::guard('employee')->check() ? Auth::guard('employee')->user() : null;

    $totalIncome = array_sum($monthlyIncome);
    $totalExpenses = array_sum($monthlyExpenses);
    $netSavings = array_sum($monthlySavings);
@endphp

<header>
    <h1>
        <svg class="icon" width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <!-- icon paths omitted for brevity -->
        </svg>
        <span data-i18n="financials">Financials</span>
    </h1>
    <div class="header-right"></div>
</header>

<div class="main-content">
    <div class="stats">
        <div class="stat-card">{{ number_format($totalIncome, 0, ',', ' ') }} ₸<br><span data-i18n="total_income">Total Income</span></div>
        <div class="stat-card">{{ number_format($totalExpenses, 0, ',', ' ') }} ₸<br><span data-i18n="total_expenses">Total Expenses</span></div>
        <div class="stat-card">{{ number_format($netSavings, 0, ',', ' ') }} ₸<br><span data-i18n="net_savings">Net Savings</span></div>
    </div>

    <div class="charts">
        <div class="chart-card" style="grid-column: span 1;">
            <h3 data-i18n="transaction_history">Transaction History</h3>
            <table style="width: 100%; font-size: 14px;">
              <thead>
                <tr>
                    <th data-i18n="date">Date</th>
                    <th data-i18n="income">Income</th>
                    <th data-i18n="expenses">Expense</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($financials as $row)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($row->date)->format('d/m/Y') }}</td>
                        <td>{{ number_format($row->income, 0, ',', ' ') }} ₸</td>
                        <td>{{ number_format($row->expense, 0, ',', ' ') }} ₸</td>
                    </tr>
                @endforeach
            </tbody>
            
            </table>
        </div>

        <div class="chart-card" style="grid-column: span 1;">
            <h3 data-i18n="income_expenses">Income & Expenses</h3>
            <canvas id="incomeExpenseChart"></canvas>
        </div>

        <div class="chart-card" style="grid-column: span 2;">
            <h3 data-i18n="net_savings">Net Savings</h3>
            <canvas id="netSavingsChart"></canvas>
        </div>
    </div>
</div>

<script>
    const incomeData = @json($monthlyIncome);
    const expenseData = @json($monthlyExpenses);
    const savingsData = @json($monthlySavings);
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="/js/financials.js"></script>
<script src="/js/lang.js"></script>
@endsection
