<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Receipt</title>
    <link rel="stylesheet" href="../css/pos-system5.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    @php
        use App\Models\User;
        if (Auth::guard('employee')->check()) {
            $employee = Auth::guard('employee')->user();
            $user = User::find($employee->user_id); // get related admin
        } else {
            $user = Auth::guard('web')->user();
            $employee = null;
        }
    @endphp
    <header>
        <div class="header-left">
            <a class="logo" href="{{ url('/') }}">Smart<span>Kasip</span></a>
        </div>
        <div class="header-right">
            <svg width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M44 24V9H24H4V24V39H24" stroke="#00A27F" stroke-width="4" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M30 30C30 29 35 27 35 27C35 27 40 29 40 30C40 38 35 40 35 40C35 40 30 38 30 30Z" fill="none"
                    stroke="#00A27F" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M4 9L24 24L44 9" stroke="#00A27F" stroke-width="4" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
            <a @if ($user) href="/profile" @elseif ($employee) href="#" @endif>
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
            </a>
        </div>
    </header>
    <div class="main-content">
        <div class="sub-header">
            <button class="back-btn">
                <i class="fas fa-arrow-left"></i> <span data-i18n="cheque"> Cheque</span>
            </button>
            <a href="#" id="languageSwitcher">EN ▼</a>
            <ul id="language-options" class="dropdown-options">
                <li onclick="selectLanguage('English')">English</li>
                <li onclick="selectLanguage('Қазақша')">Қазақша</li>
                <li onclick="selectLanguage('Русский')">Русский</li>
            </ul>
        </div>
        <div class="receipt-wrapper">
            <div class="receipt-box">
                <div class="title">ИП {{ $user->businessName }}</div>
                <div class="subtitle">BIN (IIN): {{ $user->bin }}<br>DEMO St., 1</div>
                <h2 data-i18n="cheque_title">PRELIMINARY RECEIPT</h2>

                <div class="auto">
                    <h4><strong data-i18n="auto">AUTONOMOUS</strong></h4>
                    <div class="details">
                        <div><strong data-i18n="sale">Sale</strong>: No. 13</div>
                        <div><strong data-i18n="shift">Shift</strong>: 2</div>
                        <div><strong data-i18n="cashier">Cashier</strong>: 773178</div>
                        <div><strong data-i18n="date">Date</strong>: <span id="date"></span></div>
                        <div><strong data-i18n="time">Time</strong>: <span id="time"></span></div>
                    </div>
                </div>

                <hr style="color: white;">

                <div class="items" id="items-container">
                </div>

                <hr style="color: white;">

                <div class="total">
                    <div><strong data-i18n="total">TOTAL</strong></div>
                    <div class="total-amount" id="totalAmount">0 KZT</div>
                </div>
                <div class="payment-method">
                    <div id="paymentMethod">Cash</div>
                    <div id="paidAmount">0 KZT</div>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/pos-system5.js"></script>
    <script src="../js/lang.js"></script>
</body>

</html>
