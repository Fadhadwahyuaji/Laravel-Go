@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Users</h1>
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('users.create') }}" class="btn btn-primary">Create User</a>
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
                <th>Username</th>
                <th>Role ID</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($users) && is_array($users))
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user['id'] }}</td>
                        <td>{{ $user['name'] }}</td>
                        <td>{{ $user['email'] }}</td>
                        <td>{{ $user['username'] }}</td>
                        <td>{{ $user['role_id'] }}</td>
                        <td>
                            <a href="{{ route('users.edit', $user['id']) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('users.destroy', $user['id']) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5">No users found</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
