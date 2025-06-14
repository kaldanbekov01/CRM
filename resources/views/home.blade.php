@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
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
