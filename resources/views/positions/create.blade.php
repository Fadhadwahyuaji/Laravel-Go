@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Position</h1>
    <form method="POST" action="{{ route('positions.store') }}">
        @csrf
        <div class="form-group">
            <label for="position_name">Name Position:</label>
            <input type="text" class="form-control" name="position_name" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Position</button>
    </form>
</div>
@endsection
