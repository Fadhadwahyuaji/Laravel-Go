@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Roles</h1>
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('roles.create') }}" class="btn btn-primary">Create Role</a>
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
                <th>Role Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($roles) && is_array($roles))
                @foreach($roles as $role)
                    <tr>
                        <td>{{ $role['id'] }}</td>
                        <td>{{ $role['role_name'] }}</td>
                        <td>
                            <a href="{{ route('roles.edit', $role['id']) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('roles.destroy', $role['id']) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3">No roles found</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
