<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS system 2</title>
    <link rel="icon" href="../images/logotip.jpeg" type="image/jpeg" class="logotip">
    <link rel="stylesheet" href="../css/pos-system2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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

    <div class="main-content">
        <div class="block-1">
            <div>
                <div class="sub-header" onclick="window.location.href='{{ route('posSystem.index') }}'">
                    <i class="fas fa-arrow-left"></i>
                    <button class="back-btn"> Select a product</button>
                </div>
                <table class="product-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Q-ty</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="next-total">
                <button class="next-btn">Next</button>
                <span class="total-amount">0 ₸</span>
            </div>
        </div>

        <div class="block-2">
            <div class="product-actions" style="margin-bottom: 20px;">
                <form method="GET" action="{{ route('posSystem.search') }}" class="search-bar d-flex"
                    style="max-width: 400px;">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control me-2"
                        placeholder="Search by product name or category">

                    <button type="submit" class="btn btn-outline-success"><i class="fas fa-search"></i></button>
                </form>
            </div>

            <div class="categories" id="categoryContainer">
                @if ($user)
                    <button class="add-product-btn" onclick="window.location.href='{{ route('product.create') }}'">+ Add
                        a
                        product</button>
                @endif
                @foreach ($categories as $category)
                    <div class="category-card" onclick="showProducts('{{ strtolower(trim($category->name)) }}')">
                        {{ $category->name }}
                    </div>
                @endforeach
            </div>

            <div class="products block-3" id="productContainer">
                
            </div>

        </div>
    </div>
    <script src="../js/pos-system2.js"></script>

    <script>
        const productsByCategory = {!! json_encode(
            $productsByCategory->map(function ($group) {
                return $group->map(function ($product) {
                        return [
                            'id' => $product->id,
                            'name' => $product->name,
                            'price' => $product->retail_price,
                            'stock_quantity' => $product->stock_quantity,
                        ];
                    })->values();
            }),
            JSON_UNESCAPED_UNICODE,
        ) !!};
    </script>
    <script src="../js/lang.js"></script>

</body>

</html>
