@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create User</h1>
    <form method="POST" action="{{ route('users.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <div class="form-group">
            <label for="role">Role:</label>
            <select class="form-control" name="role_id" required>
                <option value="1">Admin</option>
                <option value="2">User</option>
                <option value="3">Manager</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create User</button>
    </form>
</div>
@endsection
