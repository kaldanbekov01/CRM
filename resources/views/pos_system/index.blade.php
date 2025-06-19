@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/pos-system1.css') }}">
@endpush

@section('content')
@php
$user = Auth::guard('web')->user();
$employee = Auth::guard('employee')->check() ? Auth::guard('employee')->user() : null;
@endphp
<header>
    <h1><svg class="icon" width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="20.5" cy="41.5" r="3.5" fill="#00A27F"/><circle cx="37.5" cy="41.5" r="3.5" fill="#00A27F"/><path d="M5 6L14 12L19 34H39L44 17H25" stroke="#00A27F" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M25 26L32.2727 26L41 26" stroke="#00A27F" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
    </svg> <span data-i18n="pos_system">POS system</span></h1>
    
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
            <a href="/profile"><svg class="icon" width="24" height="24" viewBox="0 0 48 48" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <circle cx="24" cy="12" r="8" fill="none" stroke="#00A27F" stroke-width="4"
                    stroke-linecap="round" stroke-linejoin="round" />
                <path d="M42 44C42 34.0589 33.9411 26 24 26C14.0589 26 6 34.0589 6 44" stroke="#00A27F"
                    stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M24 44L28 39L24 26L20 39L24 44Z" fill="none" stroke="#00A27F" stroke-width="4"
                    stroke-linecap="round" stroke-linejoin="round" />
            </svg></a>
            <i class="fas fa-user-circle user-icon"></i>
            <div class="user-details">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" @if ($user) href="/profile" @elseif ($employee) href="#" @endif role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        @if ($user)
                            <span class="user-name">{{ $user->firstName }} {{ $user->lastName }}</span>
                            <span class="user-role">Admin</span>
                        @elseif ($employee)
                            <span class="user-name">{{ $employee->username }}</span>
                            <span class="user-role">Employee</span>
                        @endif
                    </a>
                </li>
            </div>
        </div>
    </div>
</header>

<div class="main-content">
    <div class="block-1">
        <div class="pos-screen">
            <div class="pos-header">
                <span></span>
            </div>
            <div id="pos-display" class="pos-display">0</div>
        </div>

        <button class="select-product-btn" onclick="window.location.href='{{ route('posSystem.select') }}'">+ Select a product</button>

        <div class="pos-payment">
            <button class="payment-btn" data-method="cash">
                <svg class="icon-system" width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 13H44V37H4V13Z" stroke="#007058" stroke-width="4" stroke-linejoin="round"/><path fill-rule="evenodd" clip-rule="evenodd" d="M4 21C8.41828 21 12 17.4183 12 13H4V21Z" stroke="#007058" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path fill-rule="evenodd" clip-rule="evenodd" d="M4 29C8.41828 29 12 32.5817 12 37H4V29Z" stroke="#007058" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path fill-rule="evenodd" clip-rule="evenodd" d="M44 29V37H36C36 32.5817 39.5817 29 44 29Z" stroke="#007058" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path fill-rule="evenodd" clip-rule="evenodd" d="M44 21C39.5817 21 36 17.4183 36 13H44V21Z" stroke="#007058" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M24 31C26.7614 31 29 28.3137 29 25C29 21.6863 26.7614 19 24 19C21.2386 19 19 21.6863 19 25C19 28.3137 21.2386 31 24 31Z" stroke="#007058" stroke-width="4" stroke-linejoin="round"/></svg>
                <span data-i18n="cash">Cash</span>
            </button>
            <button class="payment-btn" data-method="card">
                <svg class="icon-system" width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 15L19.3714 25.5377C20.5 26.5 22.8282 28 25 26C27.2893 23.8918 25.5 21.5 25 21L17 15" stroke="#007058" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M4 8H27L38 18" stroke="#007058" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 33L44 33.0193" stroke="#007058" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 18V40H44V18H22.0002" stroke="#007058" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <span data-i18n="card">Card</span>
            </button>
            <button class="payment-btn" data-method="qr">
                <svg class="icon-system" width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="11" y="4" width="26" height="40" rx="3" fill="none" stroke="#007058" stroke-width="4"/><path d="M22 10L26 10" stroke="#007058" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M20 38H28" stroke="#007058" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                QR
            </button>
        </div>
    
    </div>

    <div class="block-2">
        <div class="pos-keypad">
            <div class="keypad-grid">
                <button class="keypad-btn" data-value="7">7</button>
                <button class="keypad-btn" data-value="8">8</button>
                <button class="keypad-btn" data-value="9">9</button>
                <button class="keypad-btn" data-value="4">4</button>
                <button class="keypad-btn" data-value="5">5</button>
                <button class="keypad-btn" data-value="6">6</button>
                <button class="keypad-btn" data-value="1">1</button>
                <button class="keypad-btn" data-value="2">2</button>
                <button class="keypad-btn" data-value="3">3</button>
                <button class="keypad-btn" data-action="clear">C</button>
                <button class="keypad-btn" data-value="0">0</button>
                <button class="keypad-btn" data-action="delete">←</button>
                <button class="keypad-btn widep " data-action="add">+</button>
                <button class="keypad-btn wide" data-action="next">Next</button>
            </div>
        </div>
    </div>
</div>

<script src="../js/pos-system1.js"></script>
<script src="../js/lang.js"></script>
@endsection