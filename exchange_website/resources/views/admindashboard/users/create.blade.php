@extends('adminlayouts.app')

@section('content')
<div class="container">
    <h1>Add New User</h1>
    <form action="{{ route('admindashboard.users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="phone_number">Phone</label>
            <input type="text" name="phone_number" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="address">City</label>
            <input type="text" name="address" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="role_id">Role</label>
            <select name="role_id" class="form-control" required>
                <option value="" disabled selected>Select Role</option>
                <option value="1">Admin</option> <!-- يمكنك ضبط الرقم هنا بما يتناسب مع الـ role_id في قاعدة البيانات -->
                <option value="2">User</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
