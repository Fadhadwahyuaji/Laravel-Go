@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Position</h1>
    <form action="{{ route('positions.update', $position['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="position_name">Name Position:</label>
            <input type="text" class="form-control" id="position_name" name="position_name" value="{{ old('position_name', $position['position_name']) }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Position</button>
    </form>
</div>
@endsection
