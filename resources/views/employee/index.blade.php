@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('../css/employees.css') }}">
@endpush
@section('content')
    <header>
        <h1><svg class="icon" width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="24" cy="12" r="8" fill="none" stroke="#00A27F" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M42 44C42 34.0589 33.9411 26 24 26C14.0589 26 6 34.0589 6 44" stroke="#00A27F" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M24 44L28 39L24 26L20 39L24 44Z" fill="none" stroke="#00A27F" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
        </svg> <span data-i18n="employees">Employees</span></h1>
        <div class="header-right">
        </div>
    </header>

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
                            <path d="M33.2216 33.2217L41.7069 41.707" stroke="white" stroke-width="4"
                                stroke-linecap="round" stroke-linejoin="round" />
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
                            <th data-i18n="position">User ID</th>
                        </tr>
                    </thead>
                <tbody>
                    @forelse ($employees as $employee)
                        <tr>
                            <td>{{ $employee->id }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->username }}</td>
                            <td>{{ $employee->user_id }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">No employees found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-4">
                <div style="font-size: 13px;">
                    {{ $employees->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div id="employeeModal" class="modal-overlay">
            <div class="modal">
                <h2 data-i18n="add_employee">Add Employee</h2>
                <form action="{{ route('employee.store') }}" method="POST" class="modal-content">
                    @csrf
                    <label for="email" data-i18n="usernam">Username:</label>
                    <input type="text" name="username" class="form-control" value="{{ old('username') }}" required>
    
                    <label for="email" data-i18n="work_email">Email:</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
    
                    <label for="email" data-i18n="password">Password:</label>
                    <input type="password" name="password" class="form-control" required>
                   
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
    
                    <div class="modal-buttons">
                        <button type="submit" class="btn btn-success">Add Employee</button>
                        <button type="button" id="cancelBtn" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
   

    <script src="../js/employees.js"></script>
    <script src="../js/lang.js"></script>

@endsection
