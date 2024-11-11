@extends('adminlayouts.app')

@section('content')
<div class="container">
    <h1>User Details</h1>
    <p><strong>Name:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Phone:</strong> {{ $user->phone_number }}</p>
    <p><strong>City:</strong> {{ $user->address }}</p>
    <a href="{{ route('admindashboard.users.index') }}" class="btn btn-primary">Back to Users</a>
</div>
@endsection
