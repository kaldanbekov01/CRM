@extends('layouts.app')
@section('content')
<div style="margin-left: 300px; margin-top: 100px;">
    <h1 class="mb-4">All Employees</h1>

    <a href="{{ route('employee.create') }}" class="btn btn-success mb-3">➕ Add New Employee</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>User ID</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($employees as $employee)
                <tr>
                    <td>{{ $employee->id }}</td>
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
</div>
@endsection
