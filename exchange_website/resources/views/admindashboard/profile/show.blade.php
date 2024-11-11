@extends('adminlayouts.app')

@section('content')
<div class="container">
    <h1>Admin Profile</h1>
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Profile Details</h6>
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $admin->name }}</p>
            <p><strong>Email:</strong> {{ $admin->email }}</p>
            <p><strong>Password:</strong> <i>(Hidden)</i></p>
        </div>
        <div class="card-footer">
            <a href="{{ route('admindashboard.profile.edit') }}" class="btn btn-primary">Edit Profile</a>
        </div>
    </div>
</div>
@endsection
