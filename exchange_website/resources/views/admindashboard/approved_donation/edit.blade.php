@extends('adminlayouts.app')

@section('content')
<div class="container-fluid">
    <h3>Edit Donation</h3>
    <form action="{{ route('admindashboard.approved_donations.update', $donation->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="item_id">Item</label>
            <select name="item_id" class="form-control" required>
                @foreach($items as $item)
                    <option value="{{ $item->id }}" {{ $item->id == $donation->item_id ? 'selected' : '' }}>{{ $item->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="donor_id">Donor</label>
            <select name="donor_id" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $user->id == $donation->donor_id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <input type="text" name="status" class="form-control" value="{{ $donation->status }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
