@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Positions</h1>
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('positions.create') }}" class="btn btn-primary">Create Position</a>
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
                <th>Position Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($positions) && is_array($positions))
                @foreach($positions as $position)
                    <tr>
                        <td>{{ $position['id'] }}</td>
                        <td>{{ $position['position_name'] }}</td>
                        <td>
                            <a href="{{ route('positions.edit', $position['id']) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('positions.destroy', $position['id']) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3">No positions found</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
