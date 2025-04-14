<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <div class="sidebar">
        <a class="logo" href="{{ url('/') }}">Smart<span>Kasip</span></a>
        <div class="menu-wrapper">
            <ul class="menu top-menu">
                <li><a href="{{ url('/home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="#"><i class="fas fa-cash-register"></i> POS system</a></li>
                <li><a href="#"><i class="fas fa-box"></i> Orders</a></li>
                <li><a href="#"><i class="fas fa-shopping-cart"></i> Products</a></li>
                <li><a href="#"><i class="fas fa-users"></i> Clients</a></li>
                <li><a href="#"><i class="fas fa-wallet"></i> Financials</a></li>
                <li><a href="#"><i class="fas fa-chart-line"></i> Analytics</a></li>
                <li><a href="{{ route('employee.index') }}"><i class="fas fa-user-tie"></i> Employee</a></li>
            </ul>

            <ul class="menu bottom-menu">
                <li><a href="#"><i class="fas fa-headset"></i> Support service</a></li>
                <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
            </ul>
        </div>
    </div>

    <header>
        <h1><i class="fas fa-home"></i> Dashboard</h1>
        <div class="header-right">
            <i class="fas fa-envelope secure-icon"></i>
            <div class="user-info">
                <i class="fas fa-user-circle user-icon"></i>
                <div class="user-details">
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <span class="user-name">{{ Auth::user()->firstName }} {{ Auth::user()->firstName }}</span>
                            <span class="user-role">Admin</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                               {{ __('Logout') }}
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

    <main class="py-4 container">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>
