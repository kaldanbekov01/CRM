<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup More Info - SmartKasip</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="icon" href="../images/logotip.jpeg" type="image/jpeg" class="logotip">
    <link rel="stylesheet" href="../css/signup_info1.css">
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
            <div class="progress-container">
                <div class="block1">
                    <p class="step-indicator">Account Setup</p>
                    <p class="step-number">2/2</p>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill"></div>
                </div>
                <div class="sub-header" onclick="window.location.href='{{ route('register') }}'"><i class="fas fa-arrow-left"></i></div>
            </div>

            <div class="forma">
                <h2>Tell us a bit about you</h2>
                <p class="subtext">That will help us better set up your account</p>

                <form method="POST" action="{{ route('register.complete') }}" class="signup-form">
                    @csrf
                    <div class="input-row">
                        <div class="input-group">
                            <label for="first-name">First name</label>
                            <input type="text" id="first-name" name="first_name" placeholder="First Name" required>
                        </div>
                        <div class="input-group">
                            <label for="last-name">Last name</label>
                            <input type="text" id="last-name" name="last_name" placeholder="Last name" required>
                        </div>
                    </div>

                    <div class="input-group full-width">
                        <label for="business-name">Business name</label>
                        <input type="text" id="business-name" name="business_name" placeholder="Business Name" required>
                    </div>

                    <button type="submit" class="next-button">Next</button>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('frontend/js/signup_info1.js') }}"></script>
</body>
</html>
