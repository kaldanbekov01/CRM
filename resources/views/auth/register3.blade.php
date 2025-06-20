<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SmartKasip - Signup</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('frontend/images/logotip.jpeg') }}" type="image/jpeg">
    <link rel="stylesheet" href="('frontend/css/signup.css')">
</head>
<body>
<div class="container">
    <div class="left-panel">
        <a class="logo" href="{{ url('/') }}">Smart<span>Kasip</span></a>
        <h1>Make your business easier with us</h1>
        <p class="description">
            SmartKasip is a modern CRM system designed to support and automate small businesses.
            We help manage clients, orders, finances, and analytics in one user-friendly interface.
        </p>
    </div>

    <div class="right-panel">
        <h2>Sign up</h2>
        <form method="POST" action="{{ route('register') }}" class="login-form" id="signupForm">
            @csrf

            <label for="email">Work email*</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror

            <label for="bin">BIN*</label>
            <input type="text" id="bin" name="bin" value="{{ old('bin') }}" maxlength="12" required>
            @error('bin') <span class="text-danger">{{ $message }}</span> @enderror

            <label for="phone">Phone number*</label>
            <div class="phone-input">
                <select class="country-code" name="country_code">
                    <option value="+7" {{ old('country_code') == '+7' ? 'selected' : '' }}>+7</option>
                    <option value="+1" {{ old('country_code') == '+1' ? 'selected' : '' }}>+1</option>
                    <option value="+44" {{ old('country_code') == '+44' ? 'selected' : '' }}>+44</option>
                </select>
                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" maxlength="10" required>
            </div>
            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror

            <label for="password">Password*</label>
            <div class="password-wrapper">
                <input type="password" id="password" name="password" required>
                <img src="{{ asset('frontend/images/signup/eye.jpeg') }}" class="toggle-password" onclick="togglePassword('password', this)" alt="Show password">
            </div>
            @error('password') <span class="text-danger">{{ $message }}</span> @enderror

            <label for="password-confirm">Repeat the password*</label>
            <div class="password-wrapper">
                <input type="password" id="password-confirm" name="password_confirmation" required>
                <img src="{{ asset('frontend/images/signup/eye.jpeg') }}" class="toggle-password" onclick="togglePassword('password-confirm', this)" alt="Show password">
            </div>

            <p style="font-size: 13px; color: #777;">
                By registering for an account, you are consenting to our 
                <a href="#" style="color:#026451;">Terms of Service</a> and 
                <a href="#" style="color:#026451;">Global Privacy Statement</a>.<br>
                Already have an account? 
                <a href="{{ route('login') }}" style="color:#026451;">Login</a>.
            </p>

            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>
            <button type="submit">Get started free</button>
        </form>
    </div>
</div>

<script src="('../js/signup.js')"></script>
<script src="../js/lang.js"></script>
</body>
</html>
