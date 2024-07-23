@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Employees</h1>
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('employees.create') }}" class="btn btn-primary">Create Employee</a>
    </div>
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Number Phone</th>
                <th>Position ID</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($employees) && is_array($employees))
                @foreach($employees as $employee)
                    <tr>
                        <td>{{ $employee['id'] }}</td>
                        <td>{{ $employee['name'] }}</td>
                        <td>{{ $employee['email'] }}</td>
                        <td>{{ $employee['phone_number'] }}</td>
                        <td>{{ $employee['position_id'] }}</td>
                        <td>
                            <a href="{{ route('employees.edit', $employee['id']) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('employees.destroy', $employee['id']) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5">No employees found</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
