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
        <div class="header-left">
            <div class="burger" onclick="toggleMenu()">
                <div></div>
                <div></div>
                <div></div>
            </div>
        <h1>
            <svg class="icon" width="24" height="24" viewBox="0 0 48 48" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M4.68209 23.5639C4.32813 21.7145 5.74562 20 7.62861 20H40.3714C42.2544 20 43.6719 21.7145 43.3179 23.5639L40.2557 39.5639C39.9851 40.9777 38.7486 42 37.3092 42H10.6908C9.25141 42 8.01487 40.9777 7.74429 39.5639L4.68209 23.5639Z"
                    fill="none" stroke="#00A27F" stroke-width="4" stroke-linejoin="round" />
                <path d="M24 6L15 20H33L24 6Z" stroke="#00A27F" stroke-width="4" stroke-linecap="round"
                    stroke-linejoin="round" />
                <circle cx="24" cy="31" r="3" fill="none" stroke="#00A27F" stroke-width="4" />
            </svg>
            <span data-i18n="products">Products</span>
        </h1>
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
                            <path d="M33.2216 33.2217L41.7069 41.707" stroke="white" stroke-width="4"
                                stroke-linecap="round" stroke-linejoin="round" />
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
                                @if ($user)
                                    <td>
                                        <button class="edit-btn"
                                            onclick="openEditModal({{ $product->id }}, {{ $product->stock_quantity }})">
                                            ✏️
                                        </button>

                                        @if ($product->stock_quantity == 0)
                                            <button class="delete-btn" data-product-id="{{ $product->id }}"
                                                data-product-name="{{ $product->name }}" onclick="openDeleteModal(this)">
                                                🗑️
                                            </button>
                                        @endif
                                    </td>
                                @endif

                            </tr>

                            <!-- DELETE MODAL -->
                            <div id="deleteModal" class="modal-overlay" style="display: none;">
                                <div class="modal">
                                    <p id="deleteMessage">Are you sure you want to delete this product?</p>
                                    <form id="deleteForm" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-buttons"
                                            style="margin-top: 20px; display: flex; justify-content: flex-end; gap: 10px;">
                                            <button type="delete" class="btn btn-danger"
                                                data-i18n="delete">Delete</button>
                                            <button type="button" class="btn btn-secondary"
                                                onclick="closeDeleteModal()">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div id="productModal" class="modal-overlay" style="display: none;">
                                <div class="modal">
                                    <h2 data-i18n="edit_product">Edit Product</h2>
                                    <form id="editProductForm" method="POST">
                                        @csrf
                                        <div style="margin-bottom: 20px;">
                                            <label for="name" data-i18n="">Product name:</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ old('name') }}" placeholder="{{ $product->name }}" disabled>
                                        </div>
                                        <div style="margin-bottom: 20px;">
                                            <label for="barcode" data-i18n="">Barcode:</label>
                                            <input type="barcode" name="barcode" class="form-control"
                                                value="{{ old('barcode') }}" placeholder="{{ $product->barcode }}"
                                                disabled>
                                        </div>
                                        <div style="margin-bottom: 20px;">
                                            <label for="stock_quantity" data-i18n="stock_quantity">Stock
                                                Quantity::</label>
                                            <input type="text" name="stock_quantity"
                                                placeholder="{{ $product->stock_quantity }}" class="form-control"
                                                disabled>
                                        </div>
                                        <div style="margin-bottom: 20px;">
                                            <label for="stock_quantity" data-i18n="">Add count:</label>
                                            <input type="number" name="stock_quantity" id="editQuantity"
                                                class="form-control" required>
                                        </div>
                                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                                        <div class="modal-buttons"
                                            style="margin-top: 20px; display: flex; justify-content: flex-end; gap: 10px;">
                                            <button type="submit" class="btn btn-success">Update Product</button>
                                            <button type="button" id="cancelBtn" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
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

    <script src="../js/product.js"></script>
    <script src="../js/lang.js"></script>
@endsection
