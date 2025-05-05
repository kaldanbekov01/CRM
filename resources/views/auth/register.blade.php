{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="icon" href="../images/logotip.jpeg" type="image/jpeg" class="logotip">
    <link rel="stylesheet" href="../css/signup.css">
</head>
<body>
    <div class="container">
        <div class="left-panel">
            <a class="logo" href="../html/smart_main.html">Smart<span>Kasip</span></a>
            <h1>Make your business easier with us</h1>
            <p class="description">
                SmartKasip is a modern CRM system designed to support and automate small businesses.
                We help manage clients, orders, finances, and analytics in one user-friendly interface.
            </p>
        </div>
        <div class="right-panel">
            <h2>Sign up</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf
            <form class="login-form" id="signupForm">
                <label for="email">Work email*</label>
                <input type="email" id="email" placeholder="Enter your work email" required>

                <label for="bin">BIN*</label>
                <input type="text" id="bin" placeholder="112233445566" maxlength="12" required>

                <label for="phone">Phone number*</label>
                <div class="phone-input">
                    <select class="country-code" id="countryCode">
                        <option value="+7">+7</option>
                        <option value="+1">+1</option>
                        <option value="+44">+44</option>
                    </select>
                    <input type="tel" id="phone" placeholder="Enter phone number" maxlength="10" required>
                </div>

                <label for="password">Password*</label>
                <div class="password-wrapper">
                    <input type="password" id="password" placeholder="Enter password" required>
                    <img src="../images/signup/eye.jpeg" class="toggle-password" onclick="togglePassword('password', this)" alt="Show password">
                </div>
                
                <label for="confirmPassword">Repeat the password*</label>
                <div class="password-wrapper">
                    <input type="password" id="confirmPassword" placeholder="Repeat your password" required>
                    <img src="../images/signup/eye.jpeg" class="toggle-password" onclick="togglePassword('confirmPassword', this)" alt="Show password">
                </div>
                
                <p id="passwordMatchMessage" style="color: red; display: none;">Passwords don't match</p>

                <ul id="passwordRules" style="font-size: 14px; list-style: none; padding-left: 0;">
                    <li id="rule-lower">✔ One lowercase character</li>
                    <li id="rule-upper">✔ One uppercase character</li>
                    <li id="rule-number">✔ One number</li>
                    <li id="rule-special">✔ One special character</li>
                    <li id="rule-length">✔ 8 characters minimum</li>
                </ul>


                <p style="font-size: 13px; color: #777;">
                    By registering for an account, you are consenting to our 
                    <a href="#" style="color:#026451; text-decoration: none;">Terms of Service</a> and 
                    <a href="#" style="color:#026451; text-decoration: none;">Global Privacy Statement</a>.<br>
                    Do you have an account?
                    <a href="/frontend/html/login.html" style="color:#026451; text-decoration: none;">Login</a>.
                </p>

                <button type="button" onclick="submitSignup()">Get started free</button>
            </form>
        </div>
    </div>

    <script src="../js/signup.js"></script>
</body>
</html> --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SmartKasip - Signup</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/logotip.jpeg" type="image/jpeg" class="logotip">
    <link rel="stylesheet" href="../css/signup.css">
</head>
<body>
<div class="container">
    <div class="left-panel">
        <a class="logo" href="{{ url('/') }}">Smart<span>Kasip</span></a>
        <h1>Make your business easier with us</h1>
        <p class="description">
            SmartKasip is a modern CRM system designed to support and automate small businesses.
        </p>
    </div>

    <div class="right-panel">
        {{-- <div class="progress-container">
            <div class="block1">
                <p class="step-indicator">Account Setup</p>
                <p class="step-number">1/2</p>
            </div>
            <div class="progress-bar">
                <div class="progress-fill"></div>
            </div>
        </div> --}}

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
                <img src="{{ asset('../images/signup/eye.jpeg') }}" class="toggle-password" onclick="togglePassword('password', this)" alt="Show password">
            </div>
            @error('password') <span class="text-danger">{{ $message }}</span> @enderror

            <label for="password-confirm">Repeat the password*</label>
            <div class="password-wrapper">
                <input type="password" id="password-confirm" name="password_confirmation" required>
                <img src="{{ asset('../images/signup/eye.jpeg') }}" class="toggle-password" onclick="togglePassword('password-confirm', this)" alt="Show password">
            </div>

            <p id="passwordMatchMessage" style="color: red; display: none;" data-i18n="password_mismatch">Passwords don't match</p>
        
                <ul id="passwordRules" style="font-size: 14px; list-style: none; padding-left: 0;">
                    <li id="rule-lower" data-i18n="rule_lower">✔ One lowercase character</li>
                    <li id="rule-upper" data-i18n="rule_upper">✔ One uppercase character</li>
                    <li id="rule-number" data-i18n="rule_number">✔ One number</li>
                    <li id="rule-special" data-i18n="rule_special">✔ One special character</li>
                    <li id="rule-length" data-i18n="rule_length">✔ 8 characters minimum</li>
                </ul>
                <p style="font-size: 13px; color: #777;">
                    <span data-i18n="terms_note">By registering for an account, you are consenting to our </span>
                    <a href="#" style="color:#026451; text-decoration: none;" ><span data-i18n="terms_service"> Terms of Service and</span></a>  
                    <a href="#" style="color:#026451; text-decoration: none;" ><span data-i18n="privacy">Global Privacy Statement</span></a>.<br>
                    <span data-i18n="have_account?">Do you have an account?</span>
                    <a href="{{ route('login') }}" style="color:#026451; text-decoration: none;" ><span data-i18n="login_link"> Login</span></a>.
                </p>
        

            <button type="submit">Get started free</button>

            {{-- <p class="terms">
                By registering for an account, you are consenting to our 
                <a href="#">Terms of Service</a> and 
                <a href="#">Global Privacy Statement</a>.<br>
                Already have an account? 
                <a href="{{ route('login') }}">Login</a>.
            </p> --}}
        </form>
    </div>
</div>

<script src="{{ asset('js/signup.js') }}"></script>
</body>
</html>
