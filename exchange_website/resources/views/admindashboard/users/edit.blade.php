@extends('adminlayouts.app')
@section('content')
<div class="container">
    <h1>Edit User</h1>
    <form action="{{ route('admindashboard.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>
        <div class="form-group">
            <label for="phone_number">Phone</label>
            <input type="text" name="phone_number" class="form-control" value="{{ $user->phone_number }}" required>
        </div>
        <div class="form-group">
            <label for="address">City</label>
            <input type="text" name="address" class="form-control" value="{{ $user->address }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>

    </form>
</div>
@endsection
