<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    @stack('styles')

</head>

<body>
    @php
        $user = Auth::guard('web')->user();
        $employee = Auth::guard('employee')->check() ? Auth::guard('employee')->user() : null;
    @endphp
    <div class="sidebar">
        <a class="logo" href="{{ url('/') }}">Smart<span>Kasip</span></a>
        <div class="menu-wrapper">
            <ul class="menu top-menu">
                <li><a href="{{ url('/home') }}">
                        <svg class="icon" width="24" height="24" viewBox="0 0 48 48" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10 14C12.2091 14 14 12.2091 14 10C14 7.79086 12.2091 6 10 6C7.79086 6 6 7.79086 6 10C6 12.2091 7.79086 14 10 14Z"
                                fill="#00A27F" />
                            <path
                                d="M24 14C26.2091 14 28 12.2091 28 10C28 7.79086 26.2091 6 24 6C21.7909 6 20 7.79086 20 10C20 12.2091 21.7909 14 24 14Z"
                                fill="#00A27F" />
                            <path
                                d="M38 14C40.2091 14 42 12.2091 42 10C42 7.79086 40.2091 6 38 6C35.7909 6 34 7.79086 34 10C34 12.2091 35.7909 14 38 14Z"
                                fill="#00A27F" />
                            <path
                                d="M10 28C12.2091 28 14 26.2091 14 24C14 21.7909 12.2091 20 10 20C7.79086 20 6 21.7909 6 24C6 26.2091 7.79086 28 10 28Z"
                                fill="#00A27F" />
                            <path
                                d="M24 28C26.2091 28 28 26.2091 28 24C28 21.7909 26.2091 20 24 20C21.7909 20 20 21.7909 20 24C20 26.2091 21.7909 28 24 28Z"
                                fill="#00A27F" />
                            <path
                                d="M38 28C40.2091 28 42 26.2091 42 24C42 21.7909 40.2091 20 38 20C35.7909 20 34 21.7909 34 24C34 26.2091 35.7909 28 38 28Z"
                                fill="#00A27F" />
                            <path
                                d="M10 42C12.2091 42 14 40.2091 14 38C14 35.7909 12.2091 34 10 34C7.79086 34 6 35.7909 6 38C6 40.2091 7.79086 42 10 42Z"
                                fill="#00A27F" />
                            <path
                                d="M24 42C26.2091 42 28 40.2091 28 38C28 35.7909 26.2091 34 24 34C21.7909 34 20 35.7909 20 38C20 40.2091 21.7909 42 24 42Z"
                                fill="#00A27F" />
                            <path
                                d="M38 42C40.2091 42 42 40.2091 42 38C42 35.7909 40.2091 34 38 34C35.7909 34 34 35.7909 34 38C34 40.2091 35.7909 42 38 42Z"
                                fill="#00A27F" />
                        </svg> <span data-i18n="dashboard">Dashboard</span></a></li>
                <li class="hide-on-mobile"><a href="{{ route('posSystem.index') }}">
                        <svg class="icon" width="24" height="24" viewBox="0 0 48 48" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="20.5" cy="41.5" r="3.5" fill="#00A27F" />
                            <circle cx="37.5" cy="41.5" r="3.5" fill="#00A27F" />
                            <path d="M5 6L14 12L19 34H39L44 17H25" stroke="#00A27F" stroke-width="4"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M25 26L32.2727 26L41 26" stroke="#00A27F" stroke-width="4" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg> <span data-i18n="pos_system">POS system</span></a></li>
                <li><a href="{{ route('order.index') }}">
                        <svg class="icon" width="24" height="24" viewBox="0 0 48 48" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M4.68209 23.5639C4.32813 21.7145 5.74562 20 7.62861 20H40.3714C42.2544 20 43.6719 21.7145 43.3179 23.5639L40.2557 39.5639C39.9851 40.9777 38.7486 42 37.3092 42H10.6908C9.25141 42 8.01487 40.9777 7.74429 39.5639L4.68209 23.5639Z"
                                fill="none" stroke="#00A27F" stroke-width="4" stroke-linejoin="round" />
                            <path d="M24 6L15 20H33L24 6Z" stroke="#00A27F" stroke-width="4" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <circle cx="24" cy="31" r="3" fill="none" stroke="#00A27F"
                                stroke-width="4" />
                        </svg> <span data-i18n="orders">Orders</span></a></li>
                <li><a href="{{ route('product.index') }}">
                        <svg class="icon" width="24" height="24" viewBox="0 0 48 48" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M4.68209 23.5639C4.32813 21.7145 5.74562 20 7.62861 20H40.3714C42.2544 20 43.6719 21.7145 43.3179 23.5639L40.2557 39.5639C39.9851 40.9777 38.7486 42 37.3092 42H10.6908C9.25141 42 8.01487 40.9777 7.74429 39.5639L4.68209 23.5639Z"
                                fill="none" stroke="#00A27F" stroke-width="4" stroke-linejoin="round" />
                            <path d="M24 6L15 20H33L24 6Z" stroke="#00A27F" stroke-width="4" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <circle cx="24" cy="31" r="3" fill="none" stroke="#00A27F"
                                stroke-width="4" />
                        </svg> <span data-i18n="products">Products</span></a></li>
                <li><a href="{{ route('client.index') }}">
                        <svg class="icon" width="24" height="24" viewBox="0 0 48 48" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="14" cy="29" r="5" fill="none" stroke="#00A27F"
                                stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                            <circle cx="34" cy="29" r="5" fill="none" stroke="#00A27F"
                                stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                            <circle cx="24" cy="9" r="5" fill="none" stroke="#00A27F"
                                stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M24 44C24 38.4772 19.5228 34 14 34C8.47715 34 4 38.4772 4 44" stroke="#00A27F"
                                stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M44 44C44 38.4772 39.5228 34 34 34C28.4772 34 24 38.4772 24 44" stroke="#00A27F"
                                stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M34 24C34 18.4772 29.5228 14 24 14C18.4772 14 14 18.4772 14 24" stroke="#00A27F"
                                stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                        </svg> <span data-i18n="clients">Clients</span></a></li>
                @if ($user)
                    <li><a href="{{ route('financial.index') }}">
                            <svg class="icon" width="24" height="24" viewBox="0 0 48 48" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <ellipse cx="14" cy="10" rx="10" ry="5"
                                    stroke="#00A27F" stroke-width="4" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M4 10C4 10 4 14.2386 4 17C4 19.7614 8.47715 22 14 22C19.5228 22 24 19.7614 24 17C24 15.3644 24 10 24 10"
                                    stroke="#00A27F" stroke-width="4" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M4 17C4 17 4 21.2386 4 24C4 26.7614 8.47715 29 14 29C19.5228 29 24 26.7614 24 24C24 22.3644 24 17 24 17"
                                    stroke="#00A27F" stroke-width="4" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M4 24C4 24 4 28.2386 4 31C4 33.7614 8.47715 36 14 36C19.5228 36 24 33.7614 24 31C24 29.3644 24 24 24 24"
                                    stroke="#00A27F" stroke-width="4" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M4 31C4 31 4 35.2386 4 38C4 40.7614 8.47715 43 14 43C19.5228 43 24 40.7614 24 38C24 36.3644 24 31 24 31"
                                    stroke="#00A27F" stroke-width="4" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <ellipse cx="34" cy="24" rx="10" ry="5"
                                    stroke="#00A27F" stroke-width="4" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M24 24C24 24 24 28.2386 24 31C24 33.7614 28.4772 36 34 36C39.5228 36 44 33.7614 44 31C44 29.3644 44 24 44 24"
                                    stroke="#00A27F" stroke-width="4" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M24 31C24 31 24 35.2386 24 38C24 40.7614 28.4772 43 34 43C39.5228 43 44 40.7614 44 38C44 36.3644 44 31 44 31"
                                    stroke="#00A27F" stroke-width="4" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg> <span data-i18n="financials">Financials</span></a></li>
                @endif
                @if ($user)
                    <li><a href="{{ route('employee.index') }}">
                            <svg class="icon" width="24" height="24" viewBox="0 0 48 48" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="24" cy="12" r="8" fill="none" stroke="#00A27F"
                                    stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M42 44C42 34.0589 33.9411 26 24 26C14.0589 26 6 34.0589 6 44" stroke="#00A27F"
                                    stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M24 44L28 39L24 26L20 39L24 44Z" fill="none" stroke="#00A27F"
                                    stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                            </svg> <span data-i18n="employees">Employee</span></a></li>
                @endif
            </ul>

            <ul class="menu bottom-menu">
                <li><a href="{{ route('support') }}">
                        <svg class="icon" width="24" height="24" viewBox="0 0 48 48" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="5" y="5" width="38" height="38" rx="3" fill="none"
                                stroke="#00A27F" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M34 21L37 24L34 27" stroke="#00A27F" stroke-width="4" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M14 21L11 24L14 27" stroke="#00A27F" stroke-width="4" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M27 14L24 11L21 14" stroke="#00A27F" stroke-width="4" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M27 34L24 37L21 34" stroke="#00A27F" stroke-width="4" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg> <span data-i18n="support_service">Support service</span></a></li>
                <li><a href="{{ route('settings') }}">
                        <svg class="icon" width="24" height="24" viewBox="0 0 48 48" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M18.2838 43.1713C14.9327 42.1736 11.9498 40.3213 9.58787 37.867C10.469 36.8227 11 35.4734 11 34.0001C11 30.6864 8.31371 28.0001 5 28.0001C4.79955 28.0001 4.60139 28.01 4.40599 28.0292C4.13979 26.7277 4 25.3803 4 24.0001C4 21.9095 4.32077 19.8938 4.91579 17.9995C4.94381 17.9999 4.97188 18.0001 5 18.0001C8.31371 18.0001 11 15.3138 11 12.0001C11 11.0488 10.7786 10.1493 10.3846 9.35011C12.6975 7.1995 15.5205 5.59002 18.6521 4.72314C19.6444 6.66819 21.6667 8.00013 24 8.00013C26.3333 8.00013 28.3556 6.66819 29.3479 4.72314C32.4795 5.59002 35.3025 7.1995 37.6154 9.35011C37.2214 10.1493 37 11.0488 37 12.0001C37 15.3138 39.6863 18.0001 43 18.0001C43.0281 18.0001 43.0562 17.9999 43.0842 17.9995C43.6792 19.8938 44 21.9095 44 24.0001C44 25.3803 43.8602 26.7277 43.594 28.0292C43.3986 28.01 43.2005 28.0001 43 28.0001C39.6863 28.0001 37 30.6864 37 34.0001C37 35.4734 37.531 36.8227 38.4121 37.867C36.0502 40.3213 33.0673 42.1736 29.7162 43.1713C28.9428 40.752 26.676 39.0001 24 39.0001C21.324 39.0001 19.0572 40.752 18.2838 43.1713Z"
                                fill="none" stroke="#00A27F" stroke-width="4" stroke-linejoin="round" />
                            <path
                                d="M24 31C27.866 31 31 27.866 31 24C31 20.134 27.866 17 24 17C20.134 17 17 20.134 17 24C17 27.866 20.134 31 24 31Z"
                                fill="none" stroke="#00A27F" stroke-width="4" stroke-linejoin="round" />
                        </svg> <span data-i18n="settings_title">Settings</span></a></li>
            </ul>
        </div>
    </div>


    <header>
        <div class="header-left">
            <div class="burger" onclick="toggleMenu()">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <h1>
                <a href="@yield('header_link', '/home')">
                    @yield('header_icon')
                    <span data-i18n="@yield('header_i18n', 'dashboard')">@yield('header_title', 'Dashboard')</span>
                </a>
            </h1>
        </div>
        <div class="header-right">
            <svg width="24" height="24" viewBox="0 0 48 48" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M44 24V9H24H4V24V39H24" stroke="#00A27F" stroke-width="4" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M30 30C30 29 35 27 35 27C35 27 40 29 40 30C40 38 35 40 35 40C35 40 30 38 30 30Z"
                    fill="none" stroke="#00A27F" stroke-width="4" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M4 9L24 24L44 9" stroke="#00A27F" stroke-width="4" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
            <div class="user-info">
                <a href="/profile"><svg class="icon" width="24" height="24" viewBox="0 0 48 48"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="24" cy="12" r="8" fill="none" stroke="#00A27F"
                            stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M42 44C42 34.0589 33.9411 26 24 26C14.0589 26 6 34.0589 6 44" stroke="#00A27F"
                            stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M24 44L28 39L24 26L20 39L24 44Z" fill="none" stroke="#00A27F" stroke-width="4"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg></a>
                <i class="fas fa-user-circle user-icon"></i>
                <div class="user-details">
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle"  @if ($user) href="/profile" @elseif ($employee) href="#"  @endif role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @if ($user)
                                <span class="user-name">{{ $user->firstName }} {{ $user->lastName }}</span>
                                <span class="user-role">Admin</span>
                            @elseif ($employee)
                                <span class="user-name">{{ $employee->username }}</span>
                                <span class="user-role">Employee</span>
                            @endif
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item fw-bold text-center px-4 py-2" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>

                    </li>
                </div>
            </div>
        </div>
    </header>


    <div class="overlay"></div>


    <main class="py-4 container">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="../js/lang.js"></script>
    @stack('scripts')

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const logoutLink = document.querySelector('a[href="{{ route('logout') }}"]');
            const logoutForm = document.getElementById('logout-form');
    
            if (logoutLink && logoutForm) {
                logoutLink.addEventListener("click", function (e) {
                    e.preventDefault();
    
                    localStorage.removeItem("cart");
                    localStorage.removeItem("lastCategory");
                    localStorage.removeItem("posTotal");
    
                    logoutForm.submit();
                });
            }
        });
    </script>
    
</body>

</html>
