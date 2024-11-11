@extends('layouts.app')

@section('content')
<style>
    .product-details-container {
        max-width: 800px;
        margin: 50px auto;
        background: white;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        animation: fadeIn 0.5s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .product-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
    }

    .product-content {
        padding: 30px;
    }

    .product-title {
        font-size: 2.5rem;
        margin-bottom: 20px;
        color: #333;
    }

    .product-info {
        margin-bottom: 20px;
    }

    .product-info p {
        margin-bottom: 10px;
        color: #666;
    }

    .product-info strong {
        color: #333;
    }

    .product-description {
        line-height: 1.6;
        color: #555;
    }

    .action-buttons {
        display: flex;
        gap: 10px;
        margin-top: 30px;
    }

    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: bold;
    }

    .btn-edit {
        background-color: transparent;
        color: #6c757d;
    }

    .btn-delete {
        background-color: transparent;
        color: #6c757d;
    }

    .btn-edit:hover {
        color: #ffc107;
    }

    .btn-delete:hover {
        background-color: #dc3545;
        color: white;
    }

    .breadcrumb {
        padding: 10px 0;
        margin-bottom: 20px;
    }

    .breadcrumb-item + .breadcrumb-item::before {
        content: ">";
    }
</style>
<section class="banner-area bg_cover">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="banner-content">
                    <h1 class="text-white">Post Ad</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Ads</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="product-details-container">
    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="product-image">

    <div class="product-content">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="#">{{ $item->subcategory->category->name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $item->title }}</li>
            </ol>
        </nav>

        <h1 class="product-title">{{ $item->title }}</h1>

        <div class="product-info">
            <p><strong>Subcategory:</strong> {{ $item->subcategory->name }}</p>
            <p><strong>Category:</strong> {{ $item->subcategory->category->name }}</p>
            <p><strong>Status:</strong> <span class="badge bg-{{ $item->status === 'approved' ? 'success' : ($item->status === 'pending' ? 'warning' : 'danger') }}">{{ ucfirst($item->status) }}</span></p>
            <p><strong>Active or inactive:</strong> <span class="badge bg-{{ $item->show === 'active' ? 'active' : ($item->show === 'inactive' ? 'warning' : 'danger') }}">{{ ucfirst($item->show) }}</span></p>
        </div>

        <div class="product-description">
            <h3>Description</h3>
            <p>{{ $item->description }}</p>
        </div>

        <div class="action-buttons">
            <a href="{{ route('items.edit', $item->id) }}" class="btn btn-edit">
                <i class="lni lni-pencil"></i> Edit
            </a>

            <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this item?')">
                    <i class="lni lni-trash"></i> Delete
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
