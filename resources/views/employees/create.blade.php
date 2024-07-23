@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Employee</h1>
    <form method="POST" action="{{ route('employees.store') }}">
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
            <label for="phone_number">Phone Number:</label>
            <input type="text" class="form-control" name="phone_number" required>
        </div>
        <div class="form-group">
            <label for="position">Position:</label>
            <select class="form-control" name="position_id" required>
                <option value="1">Developer</option>
                <option value="2">System Analyst</option>
                <option value="3">Project Manager</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create Employee</button>
    </form>
</div>
@endsection
