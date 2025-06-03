<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset password</title>
    <link rel="icon" href="{{ asset('images/logotip.jpeg') }}" type="image/jpeg" class="logotip">
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <!-- Left panel -->
        <div class="left-panel">
            <a class="logo" href="/">Smart<span>Kasip</span></a>
            <h1 data-i18n="email_page_title">Make your business easier with us</h1>
            <p class="description" data-i18n="email_page_description">
                SmartKasip is a modern CRM system designed to support and automate small businesses.
                We help manage clients, orders, finances, and analytics in one user-friendly interface.
            </p>
        </div>

        <!-- Right panel -->
        <div class="right-panel">
            <div class="login-form">
                <h2 data-i18n="reset_password">Reset password</h2>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <!-- Email -->
                    <label for="email">{{ __('Email Address') }}</label>
                    <div class="email-input">
                        <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}"
                            class="@error('email') is-invalid @enderror" required autocomplete="email" autofocus>
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror

                    <!-- Password -->
                    <label for="password">{{ __('Password') }}</label>
                    <input id="password" type="password"
                        class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror

                    <!-- Confirm Password -->
                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" name="password_confirmation" required
                        autocomplete="new-password">

                    <!-- Submit Button -->
                    <button type="submit">{{ __('Reset Password') }}</button>
                </form>

                <!-- Optional links -->
                <div class="links">
                    <p><a href="{{ route('login') }}">{{ __('Back to login') }}</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
