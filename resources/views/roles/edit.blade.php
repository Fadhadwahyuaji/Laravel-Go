@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Role</h1>
    <form action="{{ route('roles.update', $role['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="role_name">Name role:</label>
            <input type="text" class="form-control" id="role_name" name="role_name" value="{{ old('role_name', $role['role_name']) }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update role</button>
    </form>
</div>
@endsection
