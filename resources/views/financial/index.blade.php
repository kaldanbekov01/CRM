@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('../css/financials.css') }}">
@endpush

@section('content')
    @php
        $user = Auth::guard('web')->user();
        $employee = Auth::guard('employee')->check() ? Auth::guard('employee')->user() : null;
    @endphp

    <header>
        <h1><svg class="icon" width="24" height="24" viewBox="0 0 48 48" fill="none"
                xmlns="http://www.w3.org/2000/svg">
            </svg> Financials </h1>
        <div class="header-right">
        </div>
    </header>

    <div class="main-content">
        <div class="stats">
            <div class="stat-card">1 000 000 KZT <br><span data-i18n="total_income">Total Income</span></div>
            <div class="stat-card">500 000 KZT <br><span data-i18n="total_expenses">Total Expenses</span></div>
            <div class="stat-card">500 000 KZT <br><span data-i18n="net_savings">Net savings</span></div>
          </div>
        
          <div class="charts">
            <div class="chart-card" style="grid-column: span 1;">
              <h3 data-i18n="transaction_history">Transaction History</h3>
              <table style="width: 100%; font-size: 14px;">
                <thead style="text-align: left;">
                  <tr>
                    <th data-i18n="date">Date</th>
                    <th data-i18n="type">Type</th>
                    <th data-i18n="category">Category</th>
                    <th data-i18n="amount">Amount</th>
                  </tr>
                </thead>
                <tbody>
                  <tr><td>21/03/2025</td><td>Income</td><td>Shoes</td><td>33,000 ₸</td></tr>
                  <tr><td>21/03/2025</td><td>Income</td><td>Shoes</td><td>33,000 ₸</td></tr>
                  <tr><td>21/03/2025</td><td>Income</td><td>Shoes</td><td>33,000 ₸</td></tr>
                  <tr><td>21/03/2025</td><td>Income</td><td>Shoes</td><td>33,000 ₸</td></tr>
                  <tr><td>21/03/2025</td><td>Income</td><td>Shoes</td><td>33,000 ₸</td></tr>
                  <tr><td>21/03/2025</td><td>Income</td><td>Shoes</td><td>33,000 ₸</td></tr>
                  <tr><td>21/03/2025</td><td>Income</td><td>Shoes</td><td>33,000 ₸</td></tr>
                </tbody>
              </table>
            </div>
        
            <div class="chart-card" style="grid-column: span 1;">
              <h3 data-i18n="income_expenses">Income & Expenses</h3>
              <canvas id="incomeExpenseChart"></canvas>
            </div>
        
            <div class="chart-card" style="grid-column: span 2;">
              <h3 data-i18n="net_savings">Net savings</h3>
              <canvas id="netSavingsChart"></canvas>
            </div>
          </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../js/financials.js"></script>
    <script src="../js/lang.js"></script>
@endsection
