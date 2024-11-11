@extends('layouts.app')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<section class="banner-area bg_cover">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="banner-content">
                    <h1 class="text-white">Post Ad</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Ads</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container my-5 animate__animated animate__fadeIn">
    <h1>Suggested Products</h1>
    <p>Based on your product with a discounted price of {{ $discountedPrice }}, here are some suggestions:</p>

    <div class="row">
        @foreach($suggestedItems->take(6) as $item)
            <div class="col-md-4 mb-4 animate__animated animate__fadeInUp">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" alt="{{ $item->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <p class="card-text">{{ $item->description }}</p>
                        <a href="{{ route('itemdetails', $item->id) }}" class="btn btn-primary btn-sm btn-custom">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4 animate__animated animate__fadeInUp">
        {{ $suggestedItems->links() }}
    </div>
</div>

<style>
    .btn-custom {
        background-color: #FF6B6B;
        border-color: #FF6B6B;
        color: #fff;
        transition: all 0.3s ease;
    }

    .btn-custom:hover {
        background-color: #E53935;
        border-color: #E53935;
        color: #fff;
    }
</style>
@endsection
