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
                <h4 data-i18n="need_help">Need a help?</h4>
                   <p data-i18n="contact_us"> Please contact us at <a href="mailto:help.smartkasip@gmail.com">help.smartkasip@gmail.com</a>
                </p>
            </div>
        
            <div class="faq-item">
                <div class="faq-question" ><span data-i18n="faq_1_q">How do I add a new product? </span><svg width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M36 18L24 30L12 18" stroke="#333" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
                <div class="faq-answer" >
                    <span data-i18n="faq_1_a">Go to the “Clients” section → click the “Add client” button → Fill out the form and click “Save”.</span>
                </div>
            </div>
        
            <div class="faq-item">
                <div class="faq-question" ><span data-i18n="faq_2_q">I forgot the password. What to do?</span> <svg width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M36 18L24 30L12 18" stroke="#333" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
                <div class="faq-answer" >
                    <span data-i18n="faq_2_a">On the login page, click “Forgot your password?”. Enter your email address and we will send you a recovery link.</span>
                </div>
            </div>
        
            <div class="faq-item">
                <div class="faq-question" ><span data-i18n="faq_3_q">How do I add a new cashier or employee?</span> <svg width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M36 18L24 30L12 18" stroke="#333" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
                <div class="faq-answer" >
                    <span data-i18n="faq_3_a">Go to “Employee” → click “Add employee” → Fill out the form.</span>
                </div>
            </div>
            </div>

        <script src="{{ asset('js/support.js') }}"></script>
        <script src="../js/lang.js"></script>
    @endsection
