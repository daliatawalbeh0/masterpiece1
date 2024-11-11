@extends('adminlayouts.app')

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Item Details</h1>
        <a href="{{ route('admindashboard.items.pending_donations') }}" class="btn btn-primary">Back to Pending Donations</a>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Details for Item: {{ $item->title }}</h6>
                </div>
                <div class="card-body">
                    <p><strong>User:</strong> {{ $item->TheUser->name }}</p>
                    <p><strong>Title:</strong> {{ $item->title }}</p>
                    <p><strong>Description:</strong> {{ $item->description }}</p>
                    <p><strong>Price:</strong> {{ $item->price }}</p>
                    <p><strong>Category:</strong> {{ $item->subcategory->category->name }}</p>
                    <p><strong>Subcategory:</strong> {{ $item->subcategory->name }}</p>
                    <p><strong>Condition:</strong> {{ $item->condition }}</p>
                    <p><strong>Usage Duration:</strong> {{ $item->usage_duration }}</p>
                    <p><strong>Status:</strong> {{ $item->status }}</p>
                    <p><strong>Image:</strong></p>
                    <img src="{{ asset($item->image) }}" alt="Item Image" style="width: 200px; height: 200px;">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
