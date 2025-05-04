<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Product</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/pos-system3.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>


<body>
    @php
        $user = Auth::guard('web')->user();
        $employee = Auth::guard('employee')->check() ? Auth::guard('employee')->user() : null;
    @endphp
    <header>
        <div class="header-left">
            <a class="logo" href="/">Smart<span>Kasip</span></a>
        </div>
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

    <div class="form-container">
        <h2>Add a product</h2>

        <form method="POST" action="{{ route('product.store') }}" class="product-form">
            @csrf
            <div class="form-grid">
                <!-- Левая колонка -->
                <div class="field">
                    <label>Barcode</label>
                    <input type="text" id="barcode" name="barcode" placeholder="enter" />
                </div>
                <div class="field">
                    <label>Cost price</label>
                    <input type="number" id="cost-price" name="wholesale_price" placeholder="0" />
                </div>
                <div class="field">
                    <label>Selling price</label>
                    <input type="number" id="selling-price" name="retail_price" placeholder="0" />
                </div>

                <div class="field">
                    <label>Name *</label>
                    <input type="text" id="product-name" name="name" placeholder="enter" required />
                </div>
                <div class="field">
                    <label>Mark up</label>
                    <input type="number" id="markup" name="markup" placeholder="0" />
                </div>
                <div class="field">
                    <label>&nbsp;</label>
                    <div class="switch-container">
                        <span class="switch-label active">%</span>
                        <span class="switch-label">KZT</span>
                    </div>
                </div>
                <!-- no name needed for switch-container -->

                <div class="field wide">
                    <label>Category *</label>
                    <select name="category_id" id="category_id" required>
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            @if ($category->user_id == Auth::id())
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    </select>

                    <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal"
                        data-bs-target="#addCategoryModal">
                        ➕ Add New Category
                    </button>

                    <!-- Modal for Adding New Category -->

                </div>


                <div class="field wide">
                    <label>Supplier *</label>
                    <select name="supplier_id" id="supplier_id" required>
                        <option value="">Select Supplier</option>
                        @foreach ($suppliers as $supplier)
                            @if ($supplier->user_id == Auth::id())
                                <option value="{{ $supplier->id }}">{{ $supplier->company_name }}</option>
                            @endif
                        @endforeach
                    </select>


                    <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal"
                        data-bs-target="#addSupplierModal">
                        ➕ Add New Supplier
                    </button>

                    <!-- Modal for Adding New Category -->

                </div>


                <div class="field">
                    <label>Quantity</label>
                    <div class="quantity">
                        <button type="button" id="decrease-qty">-</button>
                        <input type="number" id="quantity-value" name="stock_quantity" value="1" min="1"
                            readonly />
                        <button type="button" id="increase-qty">+</button>
                    </div>
                </div>


            </div>
            <div class="actions">
                <button type="button" class="cancel"
                    onclick="window.location.href='{{ route('posSystem.select') }}'">Cancel</button>
                <button type="submit" class="add" id="add-btn">Add</button>
            </div>

        </form>
    </div>
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('category.store') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                    <!-- fixed ID and title -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label>Category Name:</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                            required>
                    </div>

                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save Category</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>


    <!-- Modal for Adding New Supplier -->
    <div class="modal fade" id="addSupplierModal" tabindex="-1" aria-labelledby="addSupplierModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('supplier.store') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addSupplierModalLabel">Add New Supplier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Supplier Name:</label>
                        <input type="text" name="company_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Phone:</label>
                        <input type="text" name="phone" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Email:</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Address:</label>
                        <input type="text" name="address" class="form-control">
                    </div>
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save Supplier</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/pos-system3.js') }}"></script>
</body>

</html>
