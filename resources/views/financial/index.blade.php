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
        <h1><svg class="icon" width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><ellipse cx="14" cy="10" rx="10" ry="5" stroke="#00A27F" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M4 10C4 10 4 14.2386 4 17C4 19.7614 8.47715 22 14 22C19.5228 22 24 19.7614 24 17C24 15.3644 24 10 24 10" stroke="#00A27F" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M4 17C4 17 4 21.2386 4 24C4 26.7614 8.47715 29 14 29C19.5228 29 24 26.7614 24 24C24 22.3644 24 17 24 17" stroke="#00A27F" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M4 24C4 24 4 28.2386 4 31C4 33.7614 8.47715 36 14 36C19.5228 36 24 33.7614 24 31C24 29.3644 24 24 24 24" stroke="#00A27F" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M4 31C4 31 4 35.2386 4 38C4 40.7614 8.47715 43 14 43C19.5228 43 24 40.7614 24 38C24 36.3644 24 31 24 31" stroke="#00A27F" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><ellipse cx="34" cy="24" rx="10" ry="5" stroke="#00A27F" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M24 24C24 24 24 28.2386 24 31C24 33.7614 28.4772 36 34 36C39.5228 36 44 33.7614 44 31C44 29.3644 44 24 44 24" stroke="#00A27F" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M24 31C24 31 24 35.2386 24 38C24 40.7614 28.4772 43 34 43C39.5228 43 44 40.7614 44 38C44 36.3644 44 31 44 31" stroke="#00A27F" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
        </svg> <span data-i18n="financials">Financails</span></h1>
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
