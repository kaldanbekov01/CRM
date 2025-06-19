@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush

@section('content')
    @php
        $user = Auth::guard('web')->user();
        $employee = Auth::guard('employee')->check() ? Auth::guard('employee')->user() : null;
    @endphp
    <header>
        <h1><a><svg class="icon" width="24" height="24" viewBox="0 0 48 48" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <circle cx="24" cy="12" r="8" fill="none" stroke="#00A27F" stroke-width="4"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M42 44C42 34.0589 33.9411 26 24 26C14.0589 26 6 34.0589 6 44" stroke="#00A27F" stroke-width="4"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M24 44L28 39L24 26L20 39L24 44Z" fill="none" stroke="#00A27F" stroke-width="4"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg> 
                <svg onclick="window.history.back();" class="back" width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M31 36L19 24L31 12" stroke="#00A27F" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <span data-i18n="profile">Profile</span></h1>
    </header>

    <div class="main-content">
        <div class="profile-container">
            <div class="profile-header">
                <div class="profile-icon">
                    <svg class="icon-profile" width="24" height="24" viewBox="0 0 48 48" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <circle cx="24" cy="12" r="8" fill="none" stroke="#00A27F" stroke-width="4"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M42 44C42 34.0589 33.9411 26 24 26C14.0589 26 6 34.0589 6 44" stroke="#00A27F"
                            stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M24 44L28 39L24 26L20 39L24 44Z" fill="none" stroke="#00A27F" stroke-width="4"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="profile-name-role">
                    @if ($user)
                        <h2 id="profile-name">{{ $user->firstName }} {{ $user->lastName }}</h2>
                        <span class="user-role" data-i18n="admin">Admin</span>
                    @elseif ($employee)
                        <h2 id="profile-name">{{ $employee->username }}</h2>
                        <span class="user-role" data-i18n="admin">Employee</span>
                    @endif
                </div>
            </div>
            <form class="profile-form" method="POST" action="{{ route('profile.update') }}">
                @csrf
                <div class="form-group">
                    <label for="email" data-i18n="work_email">Work email*</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}">
                </div>
            
                <div class="form-group">
                    <label for="firstName" data-i18n="full_name">First Name</label>
                    <input type="text" id="firstName" name="firstName" value="{{ old('firstName', $user->firstName) }}">
                </div>
            
                <div class="form-group">
                    <label for="lastName" data-i18n="full_name">Last Name</label>
                    <input type="text" id="lastName" name="lastName" value="{{ old('lastName', $user->lastName) }}">
                </div>
            
                <div class="form-group">
                    <label for="phone" data-i18n="phone_number">Phone number</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                </div>

                <div class="profile-buttons">
                    <button type="submit" class="edit-profile" data-i18n="edit_profile">Save</button>
                    <button type="button" class="logout-btn" onclick="openLogoutModal()"
                        data-i18n="logout">Logout</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div id="logoutModal" class="modal-overlay">
        <div class="modal-box">
            <div class="logout-visual">
                <img src="../images/profile/logout.png" alt="coins" class="logout-coins" />

                <div class="modal-icon">
                    <svg class="icon-log" width="24" height="24" viewBox="0 0 48 48" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M23.9917 6H6V42H24" stroke="#00A27F" stroke-width="4" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M33 33L42 24L33 15" stroke="#00A27F" stroke-width="4" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M16 23.9917H42" stroke="#00A27F" stroke-width="4" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
            </div>

            <p class="modal-text" data-i18n="logout_confirmation">Are you sure you want<br>to logout?</p>

            <div class="modal-buttons">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                    <button type="submit" class="yes-btn" data-i18n="yes">Yes</button>
                </form>
                <button type="button" onclick="closeLogoutModal()" class="no-btn" data-i18n="no">No</button>
            </div>
        </div>
    </div>

    <script src="../js/profile.js"></script>
    <script src="../js/lang.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const logoutButton = document.querySelector('#logout-form button[type="submit"]');
    
            if (logoutButton) {
                logoutButton.addEventListener("click", function () {
                    localStorage.removeItem("cart");
                    localStorage.removeItem("lastCategory");
                    localStorage.removeItem("posTotal");
                });
            }
        });
    </script>
    
@endsection
