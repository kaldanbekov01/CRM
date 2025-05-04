@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/support.css') }}">
@endpush

@section('content')
    @php
        $user = Auth::guard('web')->user();
        $employee = Auth::guard('employee')->check() ? Auth::guard('employee')->user() : null;
    @endphp

        <header>
            <h1><i class="fas fa-shopping-cart"></i> Support Service </h1>
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
            <div class="help-box">
                <h4>Need help?</h4>
                <p> Please contact us at <a href="mailto:help.smartkasip@gmail.com">help.smartkasip@gmail.com</a></p>
            </div>

            <div class="faq-item">
                <div class="faq-question">How do I add a new product? <i class="fas fa-chevron-down"></i></div>
                <div class="faq-answer">
                    Go to the “Clients” section → click the “Add client” button → Fill out the form and click “Save”.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">I forgot the password. What to do? <i class="fas fa-chevron-down"></i></div>
                <div class="faq-answer">
                    On the login page, click “Forgot your password?”. Enter your email address and we will send you a
                    recovery link.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">How do I add a new cashier or employee? <i class="fas fa-chevron-down"></i></div>
                <div class="faq-answer">
                    Go to “Employee” → click “Add employee” → Fill out the form.
                </div>
            </div>
        </div>

        <script src="{{ asset('js/support.js') }}"></script>
    @endsection
