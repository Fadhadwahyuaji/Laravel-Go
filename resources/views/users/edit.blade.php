@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit User</h1>
    <form action="{{ route('users.update', $user['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user['name']) }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user['email']) }}" required>
        </div>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $user['username']) }}" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password">
            <small class="form-text text-muted">Leave blank to keep the current password.</small>
        </div>
        <div class="form-group">
            <label for="role_id">Role:</label>
            <select class="form-control" name="role_id" required>
                <option value="1" {{ old('role_id', $user['role_id']) == 1 ? 'selected' : '' }}>Admin</option>
                <option value="2" {{ old('role_id', $user['role_id']) == 2 ? 'selected' : '' }}>User</option>
                <option value="3" {{ old('role_id', $user['role_id']) == 3 ? 'selected' : '' }}>Manager</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update User</button>
    </form>
</div>
@endsection
