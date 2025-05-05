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
        <h1><svg class="icon" width="24" height="24" viewBox="0 0 48 48" fill="none"
                xmlns="http://www.w3.org/2000/svg">
            </svg> Products </h1>
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