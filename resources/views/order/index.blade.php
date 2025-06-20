@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/orders.css') }}">
@endpush

@section('content')
    @php
        $user = Auth::guard('web')->user();
        $employee = Auth::guard('employee')->check() ? Auth::guard('employee')->user() : null;
        $total = $orders->sum('total_amount');
    @endphp
@section('header_title', 'Orders')
@section('header_i18n', 'orders')
@section('header_link', '#')
@section('header_icon')
    <svg class="icon" width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path
            d="M4.68209 23.5639C4.32813 21.7145 5.74562 20 7.62861 20H40.3714C42.2544 20 43.6719 21.7145 43.3179 23.5639L40.2557 39.5639C39.9851 40.9777 38.7486 42 37.3092 42H10.6908C9.25141 42 8.01487 40.9777 7.74429 39.5639L4.68209 23.5639Z"
            fill="none" stroke="#00A27F" stroke-width="4" stroke-linejoin="round" />
        <path d="M24 6L15 20H33L24 6Z" stroke="#00A27F" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
        <circle cx="24" cy="31" r="3" fill="none" stroke="#00A27F" stroke-width="4" />
    </svg>
@endsection
<div class="overlay"></div>

<div class="main-content">

    <h1 data-i18n="top_orders">Top Orders</h1>
    <div class="charts">
        <div class="chart-card">
            <canvas id="lineChart"></canvas>
        </div>
        <div class="stats">
            <h3 data-i18n="total_sales_of_orders">Total Sales of Orders</h3>
            <h4>{{ number_format($total, 0, '', ',') }} KZT</h4>

            <div class="stat-wrapper">
                <div class="stat-box">
                    <span class="stat-value">
                        {{ $percentageChange > 0 ? '+' : '' }}{{ $percentageChange }}%
                    </span>
                    <span class="stat-icon">
                        {{ $percentageChange > 0 ? '↗' : ($percentageChange < 0 ? '↘' : '→') }}
                    </span>
                </div>
                <span class="stat-text" data-i18n="from_last_two_weeks">from last 2 weeks</span>
            </div>

        </div>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th><button data-i18n="order_id">ID</button></th>
                    <th><button data-i18n="date">Date</button></th>
                    <th><button data-i18n="">Products</button></th>
                    <th><button data-i18n="total_amount">Total</button></th>
                    <th><button data-i18n="status_order">Pay method</button></th>
                    <th><button data-i18n="">Employee Name</button></th>

                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ \Carbon\Carbon::parse($order['date'])->format('M d, Y') }}</td>
                        <td>
                            <ul style="padding-left: 15px; margin: 0;">
                                @foreach ($order['products'] as $product)
                                    <div>{{ $product['name'] }} × {{ $product['quantity'] }}</div>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ number_format($order['total_amount'], 0, '', ',') }} KZT</td>
                        <td>{{ $order['payment_method'] }}</td>
                        <td>{{ $order['employee_name'] ?? 'N/A' }}</td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">You don't have orders yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/orders.js') }}"></script>
<script src="../js/lang.js"></script>
<script>
    const chartLabels = @json($chartLabels);
    const chartTotals = @json($chartTotals);
    const ctxLine = document.getElementById('lineChart').getContext('2d');

    new Chart(ctxLine, {
        type: 'line',
        data: {
            labels: chartLabels,
            datasets: [{
                label: 'Daily Orders',
                data: chartTotals,
                borderColor: '#00A27F',
                backgroundColor: 'rgba(0,162,127,0.1)',
                tension: 0.4,
                fill: true,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
