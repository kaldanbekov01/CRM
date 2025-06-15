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

    <header>
        <div class="header-left">
            <div class="burger" onclick="toggleMenu()">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <h1><svg class="icon" width="24" height="24" viewBox="0 0 48 48" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M4.68209 23.5639C4.32813 21.7145 5.74562 20 7.62861 20H40.3714C42.2544 20 43.6719 21.7145 43.3179 23.5639L40.2557 39.5639C39.9851 40.9777 38.7486 42 37.3092 42H10.6908C9.25141 42 8.01487 40.9777 7.74429 39.5639L4.68209 23.5639Z"
                        fill="none" stroke="#00A27F" stroke-width="4" stroke-linejoin="round" />
                    <path d="M24 6L15 20H33L24 6Z" stroke="#00A27F" stroke-width="4" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <circle cx="24" cy="31" r="3" fill="none" stroke="#00A27F" stroke-width="4" />
                </svg> <span data-i18n="orders">Orders</span></h1>
            <div class="header-right">
                <svg width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M44 24V9H24H4V24V39H24" stroke="#00A27F" stroke-width="4" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M30 30C30 29 35 27 35 27C35 27 40 29 40 30C40 38 35 40 35 40C35 40 30 38 30 30Z" fill="none"
                        stroke="#00A27F" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M4 9L24 24L44 9" stroke="#00A27F" stroke-width="4" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <div class="user-info">
                    <svg class="icon" width="24" height="24" viewBox="0 0 48 48" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <circle cx="24" cy="12" r="8" fill="none" stroke="#00A27F" stroke-width="4"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M42 44C42 34.0589 33.9411 26 24 26C14.0589 26 6 34.0589 6 44" stroke="#00A27F"
                            stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M24 44L28 39L24 26L20 39L24 44Z" fill="none" stroke="#00A27F" stroke-width="4"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <i class="fas fa-user-circle user-icon"></i>
                    <div class="user-details">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="/profile" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                @if ($user)
                                    <span class="user-name">{{ $user->firstName }} {{ $user->lastName }}</span>
                                    <span class="user-role">Admin</span>
                                @elseif ($employee)
                                    <span class="user-name">{{ $employee->username }}</span>
                                    <span class="user-role">Employee</span>
                                @endif
                            </a>
                        </li>
                    </div>
                </div>
            </div>
        </div>
        <div class="overlay"></div>
    </header>


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
                            <td>{{ $order['order_id'] }}</td>
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
