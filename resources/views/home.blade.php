@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
@section('header_title', 'Dashboard')
@section('header_i18n', 'dashboard')
@section('header_link', '/home')
@section('header_icon')
    <svg class="icon" width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path
            d="M10 14C12.2091 14 14 12.2091 14 10C14 7.79086 12.2091 6 10 6C7.79086 6 6 7.79086 6 10C6 12.2091 7.79086 14 10 14Z"
            fill="#00A27F" />
        <path
            d="M24 14C26.2091 14 28 12.2091 28 10C28 7.79086 26.2091 6 24 6C21.7909 6 20 7.79086 20 10C20 12.2091 21.7909 14 24 14Z"
            fill="#00A27F" />
        <path
            d="M38 14C40.2091 14 42 12.2091 42 10C42 7.79086 40.2091 6 38 6C35.7909 6 34 7.79086 34 10C34 12.2091 35.7909 14 38 14Z"
            fill="#00A27F" />
        <path
            d="M10 28C12.2091 28 14 26.2091 14 24C14 21.7909 12.2091 20 10 20C7.79086 20 6 21.7909 6 24C6 26.2091 7.79086 28 10 28Z"
            fill="#00A27F" />
        <path
            d="M24 28C26.2091 28 28 26.2091 28 24C28 21.7909 26.2091 20 24 20C21.7909 20 20 21.7909 20 24C20 26.2091 21.7909 28 24 28Z"
            fill="#00A27F" />
        <path
            d="M38 28C40.2091 28 42 26.2091 42 24C42 21.7909 40.2091 20 38 20C35.7909 20 34 21.7909 34 24C34 26.2091 35.7909 28 38 28Z"
            fill="#00A27F" />
        <path
            d="M10 42C12.2091 42 14 40.2091 14 38C14 35.7909 12.2091 34 10 34C7.79086 34 6 35.7909 6 38C6 40.2091 7.79086 42 10 42Z"
            fill="#00A27F" />
        <path
            d="M24 42C26.2091 42 28 40.2091 28 38C28 35.7909 26.2091 34 24 34C21.7909 34 20 35.7909 20 38C20 40.2091 21.7909 42 24 42Z"
            fill="#00A27F" />
        <path
            d="M38 42C40.2091 42 42 40.2091 42 38C42 35.7909 40.2091 34 38 34C35.7909 34 34 35.7909 34 38C34 40.2091 35.7909 42 38 42Z"
            fill="#00A27F" />
    </svg>
@endsection
<div class="main-content">
    <div class="stats">
        <div class="stat-card">{{ number_format($totalOrders) }}<br><span data-i18n="total_orders">Total Orders</span>
        </div>
        <div class="stat-card">{{ number_format($totalSales, 0, '', ',') }} KZT<br><span data-i18n="total_sales">Total
                Sales</span></div>
        <div class="stat-card">{{ $employeeCount }} <br><span data-i18n="total_employees">Total Employees</span></div>
    </div>

    <div class="charts">
        <div class="chart-card">
            <h3><span data-i18n="top_selling_products">Top Selling products</span> <span class="subtitle"
                    data-i18n="on_this_week">on this week</span></h3>
            <ul>
                @foreach ($topProducts as $product)
                    <li><span class="dot"></span>
                        {{ $product->product ?? '—' }}
                        <span>{{ $product->quantity ?? '—' }}</span>
                    </li>
                @endforeach
            </ul>

        </div>

        <div class="chart-card">
            <h3 data-i18n="top_orders">Top Orders</h3>
            <canvas id="lineChart"></canvas>
        </div>

        <div class="chart-card">
            <h3 data-i18n="sales_by_category">Total Sales by Category</h3>
            <canvas id="pieChart"></canvas>
        </div>

        <div class="chart-card">
            <canvas id="barChart"></canvas>
        </div>
    </div>
</div>

<script>
    const weeklyOrderData = @json($weeklyOrders->values());
    const weeklyOrderLabels = @json($weeklyOrders->keys());

    const categoryLabels = @json($salesByCategory->pluck('category'));
    const categoryTotals = @json($salesByCategory->pluck('total'));

    const topProducts = @json($topProducts->pluck('product'));
    const topProductsQuantity = @json($topProducts->pluck('quantity'));
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../js/dashboard.js"></script>
<script src="../js/lang.js"></script>
@endsection
