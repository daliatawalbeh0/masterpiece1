@extends('adminlayouts.app')

@section('content')
<div class="container">
    <h1>Donation Details</h1>

    <p><strong>Title:</strong> {{ $donation->item ? $donation->item->title : 'N/A' }}</p>
    <p><strong>Description:</strong> {{ $donation->item ? $donation->item->description : 'N/A' }}</p>
    <p><strong>Donor:</strong> {{ $donation->donor ? $donation->donor->name : 'N/A' }}</p>
    <p><strong>Status:</strong> {{ $donation->status }}</p>

    <a href="{{ route('admindashboard.items.approved_donations') }}" class="btn btn-primary">Back to Donations</a>
</div>
@endsection
