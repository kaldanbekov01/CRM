<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="../images/logotip.jpeg" type="image/jpeg" class="logotip">
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>
    <div class="container">
        <div class="left-panel">
            <a class="logo" href="{{ url('/') }}">Smart<span>Kasip</span></a>
            <h1 data-i18n="email_page_title">Make your business easier with us</h1>
            <p class="description" data-i18n="login_description">
                SmartKasip is a modern CRM system designed to support and automate small businesses.
                We help manage clients, orders, finances, and analytics in one user-friendly interface.
            </p>
        </div>
        <div class="right-panel">
            <h2 data-i18n="welcome_back">Welcome back!</h2>
            <form method="POST" class="login-form" id="loginForm" action="{{ route('multi.login') }}">
                @csrf
                <label for="email" data-i18n="email">Email*</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid 
                @enderror" name="email" placeholder="Enter email"
                    value="{{ old('email') }}" required autofocus>

                <label for="password" data-i18n="password">Password*</label>
                <input id="password" type="password" name="password" placeholder="Enter password" required>

                <p id="errorMessage" data-i18n="error_message" style="color: red; display: none;">Email or password is incorrect.</p>

                @if ($errors->has('email'))
                    <p style="color: red;">{{ $errors->first('email') }}</p>
                @endif

                <button type="submit" onclick="checkLogin()" data-i18n="login">Login</button>

                <div class="links">
                    <p><span data-i18n="no_account">Don't you have an account?</span> <a data-i18n="register" href="{{ route('register') }}"> Register</a></p>
                    
                    <p><span data-i18n="forgot_password">You forgot password?</span> <a href="{{ route('password.request') }}">Reset password</a></p>
                
                </div>
            </form>
        </div>
    </div>

    <!-- Сюда добавляем скрипт -->
    <script>
        async function checkLogin() {
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            const errorMessage = document.getElementById('errorMessage');

            const fullPhone = countryCode + phone.value;

            // Сброс стилей перед новой проверкой
            email.style.border = '1px solid white';
            errorMessage.style.display = 'none';

            try {
                // Имитация запроса на сервер (замени URL на реальный бэкэнд)
                const response = await fetch('/api/check-login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        phone: fullPhone,
                        password: password.value
                    })
                });

                const result = await response.json();

                if (result.success) {
                    email.style.border = '2px solid green';
                    alert('Login successful!'); // тут можно добавить window.location.href = '/dashboard';
                } else {
                    email.style.border = '2px solid red';
                    errorMessage.style.display = 'block';
                }
            } catch (error) {
                console.error('Login request failed', error);
                errorMessage.innerText = 'Something went wrong. Try again later.';
                errorMessage.style.display = 'block';
                email.style.border = '2px solid red';
            }
        }
    </script>
    <script src="../js/lang.js"></script>
</body>

</html>
