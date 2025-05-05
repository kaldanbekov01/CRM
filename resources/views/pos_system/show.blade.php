<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS system 4</title>
    <link rel="icon" href="{{ asset('images/logotip.jpeg') }}" type="image/jpeg" class="logotip">
    <link rel="stylesheet" href="{{ asset('css/pos-system4.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    @php
    $user = Auth::guard('web')->user();
    $employee = Auth::guard('employee')->check() ? Auth::guard('employee')->user() : null;
    @endphp

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

    <div class="main-content">
        <div class="block-1">
            <div>
                <div class="sub-header">
                    <a href="{{ route('posSystem.index') }}"> <i class="fas fa-arrow-left"></i><button class="back-btn" data-i18n="select_product"> Select a product</button></a>
                </div>
                <table class="product-table">
                    <thead>
                        <tr>
                            <th data-i18n="name">Name</th>
                            <th data-i18n="q-ty">Q-ty</th>
                            <th data-i18n="price">Price</th>
                            <th data-i18n="total">Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Cart items will be dynamically populated here -->
                    </tbody>
                </table>
            </div>
        </div>

        <div class="block-2">
            <div class="payment-container">
                <div class="payment-label" data-i18n="discount">Discount</div>
                <div class="discount-section">
                    <span class="discount-label" data-i18n="discount">Discount</span>
                    <span class="discount-value">0%</span>
                </div>

                <div class="payment-label" data-i18n="payment">Payment</div>
                <div class="payment-section">
                    <div class="payment-option" id="cash">
                        <span class="payment-type">
                        <svg width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.32497 43.4996L13.81 43.4998L44.9227 12.3871L36.4374 3.90186L5.32471 35.0146L5.32497 43.4996Z" fill="none" stroke="#007058" stroke-width="4" stroke-linejoin="round"/>
                            <path d="M27.9521 12.3872L36.4374 20.8725" stroke="#007058" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span data-i18n="cash">Cash</span>
                        </span>
                        <span class="payment-amount">0 KZT</span>
                    </div>

                    <div class="payment-option" id="card">
                        <span class="payment-type">
                        <svg width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.32497 43.4996L13.81 43.4998L44.9227 12.3871L36.4374 3.90186L5.32471 35.0146L5.32497 43.4996Z" fill="none" stroke="#007058" stroke-width="4" stroke-linejoin="round"/>
                            <path d="M27.9521 12.3872L36.4374 20.8725" stroke="#007058" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span data-i18n="card">Card</span></span>
                        <span class="payment-amount">0 KZT</span>
                    </div>

                    <div class="payment-option" id="mobile">
                        <span class="payment-type">
                        <svg width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.32497 43.4996L13.81 43.4998L44.9227 12.3871L36.4374 3.90186L5.32471 35.0146L5.32497 43.4996Z" fill="none" stroke="#007058" stroke-width="4" stroke-linejoin="round"/>
                            <path d="M27.9521 12.3872L36.4374 20.8725" stroke="#007058" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span data-i18n="mobile">Mobile</span></span>
                        <span class="payment-amount">0 KZT</span>
                    </div>
                </div>

                <div class="payment-label" data-i18n="total">Total</div>
                <div class="total-section">
                    <div class="total-row">
                        <span class="total-label" data-i18n="to_pay">To pay</span>
                        <span class="total-amount">0 KZT</span>
                    </div>
                    <div class="total-row">
                        <span class="total-label" data-i18n="accepted">Accepted</span>
                        <span class="total-amount">0 KZT</span>
                    </div>
                    <div class="total-row">
                        <span class="total-label" data-i18n="change">Change</span>
                        <span id="change" class="change-amount">0 KZT</span>
                    </div>
                </div>

                <button id="next-btn" class="next-btn" data-i18n="next">Next</button>
            </div>
        </div>

    </div>

    <script src="{{ asset('js/pos-system4.js') }}"></script>

</body>
</html>
