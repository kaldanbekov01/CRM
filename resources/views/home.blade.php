@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="stats">
        <div class="stat-card">266 <br><span>Total Orders</span></div>
        <div class="stat-card">1 800 000 tg <br><span>Total Sales</span></div>
        <div class="stat-card">5 <br><span>Total Employees</span></div>
    </div>

    <div class="charts">
        <div class="chart-card">
            <h3>Top Selling products <span class="subtitle">on this week</span></h3>
            <ul>
                <li><span class="dot"></span>Nike Air <span>69</span></li>
                <li><span class="dot"></span>New Balance 550 <span>55</span></li>
                <li><span class="dot"></span>UGG women’s Tazz <span>38</span></li>
            </ul>
        </div>

        <div class="chart-card">
            <h3>Top Orders</h3>
            <canvas id="lineChart"></canvas>
        </div>

        <div class="chart-card">
            <h3>Total Sales by Category</h3>
            <canvas id="pieChart"></canvas>
        </div>

        <div class="chart-card">
            <canvas id="barChart"></canvas>
        </div>
    </div>
</div>
@endsection
