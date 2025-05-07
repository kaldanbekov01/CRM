@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
@endpush

@section('content')
    @php
        $user = Auth::guard('web')->user();
        $employee = Auth::guard('employee')->check() ? Auth::guard('employee')->user() : null;
    @endphp

    <header>
        <h1><svg class="icon" width="24" height="24" viewBox="0 0 48 48" fill="none"
                xmlns="http://www.w3.org/2000/svg">
            </svg> Products </h1>
        <div class="header-right">
        </div>
    </header>

    <div class="main-content">
        <div class="product-actions">
            <div class="search-bar">
                <form method="GET" action="{{ route('product.index') }}" class="search-bar d-flex"
                    style="max-width: 400px;">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search"
                        data-i18n="search" />
                    <button>
                        <svg width="24" height="24" viewBox="0 0 48 48" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                        </svg>
                    </button>
                </form>
            </div>

            <form method="GET" action="{{ route('product.index') }}" class="sort-form">
                <select name="category" onchange="this.form.submit()" class="form-control">
                    <option value="">Sort by Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </form>

            <button onclick="window.location.href='{{ route('product.create') }}'" class="add-product"
                data-i18n="+add_product">+ Add Product</button>
        </div>

        <div class="product-content">
            <div class="product-table">
                <table>
                    <thead>
                        <tr>
                            <th data-i18n="id">ID</th>
                            <th data-i18n="name_required">Name</th>
                            <th data-i18n="cost_price">Bar Code</th>
                            <th data-i18n="stock_quantity">Stock Quantity</th>
                            <th data-i18n="supplier_id">Supplier ID</th>
                            @if($user)<th data-i18n="wholesale_price">WholeSale Price</th>@endif
                            <th data-i18n="selling_price">Selling Price</th>
                            <th data-i18n="category">Category</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->barcode }}</td>
                                <td>{{ $product->stock_quantity }}</td>
                                <td>{{ $product->supplier->company_name ?? '—' }}</td>
                                @if($user)<td>{{ $product->wholesale_price }} ₸</td>@endif
                                <td>{{ $product->retail_price }} ₸</td>
                                <td>{{ $product->category->name ?? '—' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No products found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="../js/lang.js"></script>
@endsection
