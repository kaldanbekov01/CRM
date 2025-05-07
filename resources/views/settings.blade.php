@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/settings.css') }}">
@endpush

@section('content')
    @php
        $user = Auth::guard('web')->user();
        $employee = Auth::guard('employee')->check() ? Auth::guard('employee')->user() : null;
    @endphp

    <header>
        <h1><svg class="icon" width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18.2838 43.1713C14.9327 42.1736 11.9498 40.3213 9.58787 37.867C10.469 36.8227 11 35.4734 11 34.0001C11 30.6864 8.31371 28.0001 5 28.0001C4.79955 28.0001 4.60139 28.01 4.40599 28.0292C4.13979 26.7277 4 25.3803 4 24.0001C4 21.9095 4.32077 19.8938 4.91579 17.9995C4.94381 17.9999 4.97188 18.0001 5 18.0001C8.31371 18.0001 11 15.3138 11 12.0001C11 11.0488 10.7786 10.1493 10.3846 9.35011C12.6975 7.1995 15.5205 5.59002 18.6521 4.72314C19.6444 6.66819 21.6667 8.00013 24 8.00013C26.3333 8.00013 28.3556 6.66819 29.3479 4.72314C32.4795 5.59002 35.3025 7.1995 37.6154 9.35011C37.2214 10.1493 37 11.0488 37 12.0001C37 15.3138 39.6863 18.0001 43 18.0001C43.0281 18.0001 43.0562 17.9999 43.0842 17.9995C43.6792 19.8938 44 21.9095 44 24.0001C44 25.3803 43.8602 26.7277 43.594 28.0292C43.3986 28.01 43.2005 28.0001 43 28.0001C39.6863 28.0001 37 30.6864 37 34.0001C37 35.4734 37.531 36.8227 38.4121 37.867C36.0502 40.3213 33.0673 42.1736 29.7162 43.1713C28.9428 40.752 26.676 39.0001 24 39.0001C21.324 39.0001 19.0572 40.752 18.2838 43.1713Z" fill="none" stroke="#00A27F" stroke-width="4" stroke-linejoin="round"/><path d="M24 31C27.866 31 31 27.866 31 24C31 20.134 27.866 17 24 17C20.134 17 17 20.134 17 24C17 27.866 20.134 31 24 31Z" fill="none" stroke="#00A27F" stroke-width="4" stroke-linejoin="round"/>
        </svg> <span data-i18n="settings_title">Settings</span></h1>
        <div class="header-right">
        </div>
    </header>


    <div class="main-content">
        <div class="settings-card">
          <h2 data-i18n="employee_settings">Employee Settings</h2>
          <p class="subtitle" data-i18n="employee_subtitle">Control employee access rights</p>
        </div>  

        <div class="settings-card">
            <div class="employee-access-form">
              <div class="access">
                <label for="employeeDropdown" data-i18n="access_for">Access for</label>
                <div class="employee-dropdown" onclick="toggleEmployeeDropdown()">
                  <span id="selectedEmployee" data-i18n="select_employee">Select employee</span>
                  <i class="fas fa-chevron-down arrow-icon"></i>
                </div>
              
                <ul id="employee-options" class="dropdown-options">
                  <li onclick="selectEmployee('Aidyn')">Aidyn</li>
                  <li onclick="selectEmployee('Banu')">Banu</li>
                  <li onclick="selectEmployee('Elnura')">Elnura</li>
                </ul>
              </div>
          
              <div class="access-switch">
                <span data-i18n="add_product">Add product</span>
                <label class="switch">
                  <input type="checkbox" id="addProduct">
                  <span class="slider"></span>
                </label>
              </div>
          
              <div class="access-switch">
                <span data-i18n="view_orders">View orders</span>
                <label class="switch">
                  <input type="checkbox" id="viewOrders">
                  <span class="slider"></span>
                </label>
              </div>
          
              <div class="access-switch">
                <span data-i18n="financials">Financials</span>
                <label class="switch">
                  <input type="checkbox" id="financials">
                  <span class="slider"></span>
                </label>
              </div>
          
              <div class="access-buttons">
                <button class="send-btn" data-i18n="send">Send</button>
              </div>
            </div>
        </div>
          
          
        <div class="language-card">
            <div class="language-labels">
              <h2 data-i18n="language_selection">Language Selection</h2>
              <p class="subtitle" data-i18n="language_subtitle">Change the language of your interface</p>
            </div>
          
            <div class="language-dropdown" onclick="toggleLanguageDropdown()">
              <span id="selected-language">Select Language</span>
              <i class="fas fa-chevron-right arrow-icon"></i>
            </div>
          
            <ul id="language-options" class="dropdown-options">
              <li onclick="selectLanguage('English')">English</li>
              <li onclick="selectLanguage('Қазақша')">Қазақша</li>
              <li onclick="selectLanguage('Русский')">Русский</li>
            </ul>
        </div>
    </div>
    <script src="../js/settings.js"></script>
    <script src="../js/lang.js"></script>
@endsection