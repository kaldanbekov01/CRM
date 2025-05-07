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
        <h1><svg class="icon" width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.68209 23.5639C4.32813 21.7145 5.74562 20 7.62861 20H40.3714C42.2544 20 43.6719 21.7145 43.3179 23.5639L40.2557 39.5639C39.9851 40.9777 38.7486 42 37.3092 42H10.6908C9.25141 42 8.01487 40.9777 7.74429 39.5639L4.68209 23.5639Z" fill="none" stroke="#00A27F" stroke-width="4" stroke-linejoin="round"/><path d="M24 6L15 20H33L24 6Z" stroke="#00A27F" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><circle cx="24" cy="31" r="3" fill="none" stroke="#00A27F" stroke-width="4"/>
        </svg> <span data-i18n="products">Products</span></h>
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
                            <path
                                d="M21 38C30.3888 38 38 30.3888 38 21C38 11.6112 30.3888 4 21 4C11.6112 4 4 11.6112 4 21C4 30.3888 11.6112 38 21 38Z"
                                fill="none" stroke="white" stroke-width="4" stroke-linejoin="round" />
                            <path
                                d="M26.657 14.3431C25.2093 12.8954 23.2093 12 21.0001 12C18.791 12 16.791 12.8954 15.3433 14.3431"
                                stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M33.2216 33.2217L41.7069 41.707" stroke="white" stroke-width="4" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </button>
                </form>
            </div>

            <div class="sort-bar">
                <form method="GET" action="{{ route('product.index') }}" class="sort-form">
                    <select name="category" onchange="this.form.submit()" class="form-control">
                        <option value="">Sort by Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>

            @if ($user)
                <button onclick="window.location.href='{{ route('product.create') }}'" class="add-product"
                    data-i18n="+add_product">+ Add Product</button>
            @endif
        </div>

        <div class="product-content">
            <div class="product-table">
                <table>
                    <thead>
                        <tr>
                            <th data-i18n="id">ID</th>
                            <th data-i18n="name_required">Name</th>
                            <th data-i18n="barcode">Bar Code</th>
                            <th data-i18n="stock_quantity">Stock Quantity</th>
                            <th data-i18n="supplier_id">Supplier ID</th>
                            @if ($user)
                                <th data-i18n="cost_price">WholeSale Price</th>
                            @endif
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
                                @if ($user)
                                    <td>{{ $product->wholesale_price }}₸</td>
                                @endif
                                <td>{{ $product->retail_price }}₸</td>
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
