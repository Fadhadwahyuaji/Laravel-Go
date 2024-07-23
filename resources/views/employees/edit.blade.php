@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Employee</h1>
    <form action="{{ route('employees.update', $employee['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $employee['name']) }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $employee['email']) }}" required>
        </div>
        <div class="form-group">
            <label for="phone_number">Phone Number:</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $employee['phone_number']) }}" required>
        </div>
        <div class="form-group">
            <label for="position_id">Position:</label>
            <select class="form-control" name="position_id" required>
                <option value="1" {{ old('position_id', $employee['position_id']) == 1 ? 'selected' : '' }}>Developer</option>
                <option value="2" {{ old('position_id', $employee['position_id']) == 2 ? 'selected' : '' }}>System Analyst</option>
                <option value="3" {{ old('position_id', $employee['position_id']) == 3 ? 'selected' : '' }}>Project Manager</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Employee</button>
    </form>
</div>
@endsection
