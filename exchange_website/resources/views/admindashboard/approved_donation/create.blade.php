@extends('adminlayouts.app')

@section('content')
<div class="container-fluid">
    <h3>Create Donation</h3>
    <form action="{{ route('admindashboard.approved_donations.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="item_id">Item</label>
            <select name="item_id" class="form-control" required>
                @foreach($items as $item)
                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="donor_id">Donor</label>
            <select name="donor_id" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <input type="text" name="status" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
