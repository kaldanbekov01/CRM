<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartKasip</title>
    <link rel="icon" href="../images/logotip.jpeg" type="image/jpeg" class="logotip">
    <link rel="stylesheet" href="../css/style_main.css">
</head>

<body>
    <header>
        <a class="logo" href="">Smart<span>Kasip</span></a>
        <div class="burger" onclick="toggleMenu()">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <nav>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/home') }}" class="login">Dashboard</a>
                @else
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" data-i18n="get_demo" class="getDemo">Get a demo</a>
                        <a href="{{ route('login') }}" class="login" data-i18n="login">Login</a>
                        <a href="#" id="languageSwitcher">EN ▼</a>
                        <ul id="language-options" class="dropdown-options">
                            <li onclick="selectLanguage('English')">English</li>
                            <li onclick="selectLanguage('Қазақша')">Қазақша</li>
                            <li onclick="selectLanguage('Русский')">Русский</li>
                        </ul>
                    @endif
                @endauth
            @endif
        </nav>
    </header>

    <section class="hero">
        <h1><span data-i18n="hero_title1">Your personal business assistant a</span> <span class="highlight">CRM</span>
            <span data-i18n="hero_title2">that thinks for you</span></h1>
        <p data-i18n="hero_subtitle"> Accept payments and issue receipts without buying a cash register immediately
            after registering with SMARTKASIP</p>
        <button onclick="window.location='{{ route('register') }}'" class="cta-button" data-i18n="hero_button">Get
            started for free</button>
    </section>

    <section class="business-section">
        <h1 data-i18n="business_title">Suitable for any business</h1>
        <div class="business-grid">
            <div class="business-card retail">
                <div>
                    <h2 data-i18n="retail_title">Retail and wholesale</h2>
                    <p data-i18n="retail_desc">Stores "at home", fairs, wholesale and retail markets — accepting cash
                        payments</p>
                </div>
                <img src="../images/smart_main/retail.png" alt="Retail" />
            </div>
            <div class="business-card catering">
                <div class="catering-text">
                    <h2 data-i18n="catering_title">Catering</h2>
                    <p data-i18n="catering_desc">Cafes, restaurants, coffee shops that accept cashless payments on the
                        website and in the app</p>
                </div>
                <img src="../images/smart_main/image.png" alt="Catering" class="catering-image" />
            </div>
            <div class="business-card cashier">
                <img src="../images/smart_main/cashier.png" alt="Cashier" />
                <p data-i18n="cashier_desc">Use the cashier to accept cash payments or non-cash payments on your own
                    website</p>
            </div>
        </div>
    </section>

    <section class="features">
        <h1 data-i18n="features_title">Functional features</h1>

        <div class="carousel-wrapper">
            <button class="carousel-btn prev">&#8592;</button>

            <div class="features-grid">
                <div class="feature">
                    <div class="feature-icon">
                        <img src="../images/smart_main/image.2.png" alt="Shifts" />
                    </div>
                    <p data-i18n="feature_1">Automatic closing of shifts</p>
                </div>
                <div class="feature">
                    <div class="feature-icon">
                        <img src="../images/smart_main/image.3.png" alt="Registers" />
                    </div>
                    <p data-i18n="feature_2">Opening of several cash registers</p>
                </div>
                <div class="feature">
                    <div class="img4">
                        <img src="../images/smart_main/image.4.jpg" alt="TapPayDone" />
                    </div>
                    <p data-i18n="feature_3">Tap. Pay. Done.</p>
                </div>
            </div>
            <button class="carousel-btn next">&#8594;</button>
        </div>
    </section>

    <section class="payment-automation">
        <div class="payment-content">
            <h3 data-i18n="receipt_title">Punch receipts automatically</h3>
            <p data-i18n="receipt_text">Connect the POS payment terminal to SmartKasip and automate the issuance of
                checks to customers</p>
        </div>
        <div class="payment-logos">
            <img src="../images/smart_main/kaspi_logo.png" alt="Kaspi Bank" />
            <img src="../images/smart_main/halyk_logo.png" alt="Halyk Bank" />
            <img src="../images/smart_main/freedom_logo.png" alt="Freedom Holding" />
        </div>
    </section>

    <section class="devices">
        <h1 data-i18n="device_title">Work from any device</h1>
        <p data-i18n="device_desc">Accept payments and issue receipts without buying a cash register immediately after
            registering with SmartKasip</p>
        <div class="device-image">
            <img src="../images/smart_main/laptop.png" alt="SmartKasip Dashboard" />
        </div>
    </section>

    <footer>
        <div class="footer-container">
            <div class="footer-left">
                <div class="logo">Smart<span>Kasip</span></div>
                <div class="social-icons">
                    <a href="#"><img src="../images/smart_main/instagram_icon.png" alt="Instagram" /></a>
                    <a href="#"><img src="../images/smart_main/facebook_icon.png" alt="Facebook" /></a>
                    <a href="#"><img src="../images/smart_main/telegram_icon.png" alt="Telegram" /></a>
                </div>
                <p class="email">help.smartkasip@gmail.com</p>
                <p class="phone">8 (777) 111 22 33</p>
            </div>
            <div class="footer-right">
                <nav class="footer-links">
                    <a href="#" data-i18n="terms">Terms</a>
                    <a href="#" data-i18n="cookies">Cookies</a>
                    <a href="#" data-i18n="privacy">Privacy</a>
                    <a class="copyright" data-i18n="copyright">&copy; 2025, SmartKasip</a>
                </nav>
            </div>
        </div>
    </footer>
    <script src="../js/lang.js"></script>
    <script src="../js/smart_main.js"></script>
</body>

</html>
