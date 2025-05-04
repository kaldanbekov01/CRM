@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
@endpush

@section('content')
    @php
        $user = Auth::guard('web')->user();
        $employee = Auth::guard('employee')->check() ? Auth::guard('employee')->user() : null;
    @endphp

    <div class="main-content" style="margin-left: 250px;">
        <header>
            <h1><i class="fas fa-shopping-cart"></i> Products </h1>
            <div class="header-right">
                <i class="fas fa-envelope secure-icon"></i>
                <div class="user-info">
                    <i class="fas fa-user-circle user-icon"></i>
                    <div class="user-details">
                        @if ($user)
                            <span class="user-name">{{ $user->firstName }} {{ $user->lastName }}</span>
                            <span class="user-role">Admin</span>
                        @elseif ($employee)
                            <span class="user-name">{{ $employee->username }}</span>
                            <span class="user-role">Employee</span>
                        @endif
                    </div>
                </div>
            </div>
        </header>

        <!-- Search Form -->
        <div class="product-actions" style="margin-bottom: 20px;">
            <form method="GET" action="{{ route('product.index') }}" class="search-bar d-flex" style="max-width: 400px;">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control me-2"
                    placeholder="Search by product name or category">
                <button type="submit" class="btn btn-outline-success"><i class="fas fa-search"></i></button>
            </form>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success mt-2">{{ session('success') }}</div>
        @endif

        <!-- Product Table -->
        <div class="product-table">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Stock</th>
                        <th>Supplier</th>
                        <th>Cost Price</th>
                        <th>Selling Price</th>
                        <th>Mark Up</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name ?? '—' }}</td>
                            <td>{{ $product->stock_quantity }}</td>
                            <td>{{ $product->supplier->company_name ?? '—' }}</td>
                            <td>{{ $product->wholesale_price }} ₸</td>
                            <td>{{ $product->retail_price }} ₸</td>
                            <td>{{ $product->retail_price - $product->wholesale_price }} ₸</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $products->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection
