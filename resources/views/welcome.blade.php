<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartKasip</title>
    <link rel="icon" href="../images/logotip.jpeg" type="image/jpeg" class="logotip">
    <link rel="stylesheet" href="{{ asset('css/style_main.css') }}">
</head>

<body>
    <header>
        <div class="logo">Smart<span>Kasip</span></div>
        <nav>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/home') }}" class="login">Dashboard</a>
                @else
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="getDemo">Get a demo</a>
                        <a href="{{ route('login') }}" class="login">Login</a>
                        <a href="#">EN <span class="arrow"></span></a>
                    @endif
                @endauth
            @endif
        </nav>
    </header>

    <section class="hero">
        <h1>Your personal business assistant <br> <span class="highlight">A CRM</span> that thinks for you</h1>
        <p>Accept payments and issue receipts without buying a cash <br>register immediately after registering with
            SMARTKASIP</p>
        <button class="cta-button">Get started for free</button>
    </section>

    <section class="business-section">
        <h1>Suitable for any business</h1>
        <div class="business-grid">
            <div class="business-card retail">
                <h2>Retail and wholesale</h2>
                <p>Stores "at home", fairs, wholesale and retail markets — accepting cash payments</p>
            </div>
            <div class="business-card catering">
                <div class="catering-text">
                    <h2>Catering</h2>
                    <p>Cafes, restaurants, coffee shops that accept cashless payments on the website and in the app</p>
                </div>
                <img src="../images/smart_main/image.png" alt="Catering business">
            </div>
            <div class="business-card cashier">
                <p>Use the cashier to accept cash payments or non-cash payments on your own website</p>
            </div>
        </div>
    </section>

    <section class="features">
        <h1>Functional features</h1>
        <div class="features-grid">
            <div class="feature">
                <div class="feature-icon">
                    <img src="../images/smart_main/image.2.png" alt="Shifts">
                </div>
                <p>Automatic closing <br> of shifts</p>
            </div>
            <div class="feature">
                <div class="feature-icon">
                    <img src="../images/smart_main/image.3.png" alt="Registers">
                </div>
                <p>Opening of several <br> cash registers</p>
            </div>
        </div>
    </section>

    <section class="payment-automation">
        <div class="payment-content">
            <h3>Punch receipts automatically</h3>
            <p>Connect the POS payment terminal to SmartKasip and automate the issuance of checks to customers</p>
        </div>
        <div class="payment-logos">
            <img src="../images/smart_main/kaspi_logo.png" alt="Kaspi Bank">
            <img src="../images/smart_main/halyk_logo.png" alt="Halyk Bank">
            <img src="../images/smart_main/freedom_logo.png" alt="Freedom Holding">
        </div>
    </section>

    <section class="devices">
        <h1>Work from any device</h1>
        <p>Accept payments and issue receipts without buying a cash register immediately after registering with
            SmartKasip</p>
        <div class="device-image">
            <img src="../images/smart_main/laptop.png" alt="SmartKasip Dashboard">
        </div>
    </section>

    <footer>
        <div class="footer-container">
            <div class="footer-left">
                <div class="logo">Smart<span>Kasip</span></div>
                <div class="social-icons">
                    <a href="#"><img src="../images/smart_main/instagram_icon.png" alt="Instagram"></a>
                    <a href="#"><img src="../images/smart_main/facebook_icon.png" alt="Facebook"></a>
                    <a href="#"><img src="../images/smart_main/telegram_icon.png" alt="Telegram"></a>
                </div>
                <p class="email">help.smartkasip@gmail.com</p>
                <p class="phone">8 (777) 111 22 33</p>
            </div>
            <div class="footer-right">
                <nav class="footer-links">
                    <a href="#">Terms</a>
                    <a href="#">Cookies</a>
                    <a href="#">Privacy</a>
                    <a class="copyright">&copy; 2025, SmartKasip</a>
                </nav>
            </div>
        </div>
    </footer>
</body>

</html>
