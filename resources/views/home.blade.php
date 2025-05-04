@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
<div class="main-content">
    <div class="stats">
        <div class="stat-card">266 <br><span data-i18n="total_orders">Total Orders</span></div>
        <div class="stat-card">1 800 000 KZT<br><span data-i18n="total_sales">Total Sales</span></div>
        <div class="stat-card">5 <br><span data-i18n="total_employees">Total Employees</span></div>
    </div>

    <div class="charts">
        <div class="chart-card">
            <h3><span data-i18n="top_selling_products">Top Selling products</span> <span class="subtitle" data-i18n="on_this_week">on this week</span></h3>
            <ul>
                <li><span class="dot"></span>Nike Air <span>69</span></li>
                <li><span class="dot"></span>New Balance 550 <span>55</span></li>
                <li><span class="dot"></span>UGG women’s Tazz <span>38</span></li>
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
@endsection
