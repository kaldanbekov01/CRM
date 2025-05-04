@extends('layouts.app')
@section('content')
    <div style="margin-left: 300px; margin-top: 100px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">All Employees</h1>
            <form method="GET" action="{{ route('employee.index') }}" class="d-flex" style="max-width: 400px;">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control me-2"
                    placeholder="Search by email or username">
                <button type="submit" class="btn btn-outline-success">Search</button>
            </form>
        </div>
        <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
            ➕ Add New Employee
        </button>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>User ID</th>
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
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('employee.store') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addEmployeeModalLabel">Add New Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label>Username:</label>
                        <input type="text" name="username" class="form-control" value="{{ old('username') }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Email:</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Password:</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add Employee</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>

@endsection
