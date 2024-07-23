@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Role</h1>
    <form method="POST" action="{{ route('roles.store') }}">
        @csrf
        <div class="form-group">
            <label for="role_name">Name Role:</label>
            <input type="text" class="form-control" name="role_name" required>
        </div>
        <button type="submit" class="btn btn-primary">Create role</button>
    </form>
</div>
@endsection
