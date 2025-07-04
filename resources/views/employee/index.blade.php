@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('../css/employees.css') }}">
@endpush
@section('content')
    @php
        $user = Auth::guard('web')->user();
        $employee = Auth::guard('employee')->check() ? Auth::guard('employee')->user() : null;
    @endphp
@section('header_title', 'Employees')
@section('header_i18n', 'employees')
@section('header_link', '#')
@section('header_icon')
    <svg class="icon" width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="24" cy="12" r="8" fill="none" stroke="#00A27F" stroke-width="4" stroke-linecap="round"
            stroke-linejoin="round" />
        <path d="M42 44C42 34.0589 33.9411 26 24 26C14.0589 26 6 34.0589 6 44" stroke="#00A27F" stroke-width="4"
            stroke-linecap="round" stroke-linejoin="round" />
        <path d="M24 44L28 39L24 26L20 39L24 44Z" fill="none" stroke="#00A27F" stroke-width="4" stroke-linecap="round"
            stroke-linejoin="round" />
    </svg>
@endsection
{{-- <header>
        <div class="header-left">
            <div class="burger" onclick="toggleMenu()">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <h1><svg class="icon" width="24" height="24" viewBox="0 0 48 48" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <circle cx="24" cy="12" r="8" fill="none" stroke="#00A27F" stroke-width="4"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M42 44C42 34.0589 33.9411 26 24 26C14.0589 26 6 34.0589 6 44" stroke="#00A27F" stroke-width="4"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M24 44L28 39L24 26L20 39L24 44Z" fill="none" stroke="#00A27F" stroke-width="4"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg> <span data-i18n="employees">Employees</span></h1>
        </div>
        <div class="header-right">
            <svg width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M44 24V9H24H4V24V39H24" stroke="#00A27F" stroke-width="4" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M30 30C30 29 35 27 35 27C35 27 40 29 40 30C40 38 35 40 35 40C35 40 30 38 30 30Z" fill="none"
                    stroke="#00A27F" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M4 9L24 24L44 9" stroke="#00A27F" stroke-width="4" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
            <div class="user-info">
                <a href="/profile"><svg class="icon" width="24" height="24" viewBox="0 0 48 48" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <circle cx="24" cy="12" r="8" fill="none" stroke="#00A27F" stroke-width="4"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M42 44C42 34.0589 33.9411 26 24 26C14.0589 26 6 34.0589 6 44" stroke="#00A27F" stroke-width="4"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M24 44L28 39L24 26L20 39L24 44Z" fill="none" stroke="#00A27F" stroke-width="4"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg></a>
                <i class="fas fa-user-circle user-icon"></i>
                <div class="user-details">
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="/profile" role="button"
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
    </header> --}}
<div class="overlay"></div>

<div class="main-content">
    <div class="employee-actions">
        <div class="search-bar">
            <form method="GET" action="{{ route('employee.index') }}" class="d-flex" style="max-width: 400px;">
                <input type="text" name="search" value="{{ request('search') }}" data-i18n="search"
                    placeholder="Search" />
                <button type="submit">
                    <svg width="24" height="24" viewBox="0 0 48 48" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M21 38C30.3888 38 38 30.3888 38 21C38 11.6112 30.3888 4 21 4C11.6112 4 4 11.6112 4 21C4 30.3888 11.6112 38 21 38Z"
                            fill="none" stroke="white" stroke-width="4" stroke-linejoin="round" />
                        <path
                            d="M26.657 14.3431C25.2093 12.8954 23.2093 12 21.0001 12C18.791 12 16.791 12.8954 15.3433 14.3431"
                            stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M33.2216 33.2217L41.7069 41.707" stroke="white" stroke-width="4" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
            </form>
        </div>
        <button class="add-employee">+ <span data-i18n="add_employee">Add Employee</span></button>
    </div>

    <div class="employee-content">
        <div class="employee-table">
            <table>
                <thead>
                    <tr>
                        <th data-i18n="id">ID</th>
                        <th data-i18n="email">Email</th>
                        <th data-i18n="username">Username</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($employees as $employee)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->username }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">No employees found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{-- <div class="d-flex justify-content-center mt-4">
                <div style="font-size: 13px;">
                    {{ $employees->appends(request()->query())->links() }}
                </div>
            </div> --}}
        </div>
        <!-- Modal -->
        <div id="employeeModal" class="modal-overlay">
            <div class="modal">
                <h2 data-i18n="add_employee">Add Employee</h2>
                <form action="{{ route('employee.store') }}" method="POST" class="modal-content">
                    @csrf
                    <label for="username" data-i18n="username">Username:</label>
                    <input type="text" name="username" class="form-control" value="{{ old('username') }}" required>

                    <label for="email" data-i18n="work_email">Email:</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>

                    <label for="email" data-i18n="password">Password:</label>
                    <input type="password" name="password" class="form-control" required>

                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                    <div class="modal-buttons">
                        <button type="submit" class="btn btn-success">Add Employee</button>
                        <button type="button" id="cancelBtn" class="btn btn-secondary"
                            data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <script src="../js/employees.js"></script>
    <script src="../js/lang.js"></script>
@endsection
