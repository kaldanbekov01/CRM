<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Employee</title>
</head>
<body>
    <h1>Add New Employee</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('employee.store') }}" method="POST">
        @csrf

        <label>Username:</label>
        <input type="text" name="username" value="{{ old('username') }}" required><br><br>

        <label>Password:</label>
        <input type="password" name="password" required><br><br>

        <input type="hidden" name="user_id" value="{{ Auth::id() }}"> {{-- Assuming auth is enabled --}}

        <button type="submit">Add Employee</button>
    </form>

    <a href="{{ route('employee.index') }}">← Back to Employees</a>
</body>
</html>
