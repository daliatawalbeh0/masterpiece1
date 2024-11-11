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
        height: 300px;
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

    .form-group label {
        font-weight: bold;
        margin-bottom: 10px;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 10px;
        border-radius: 4px;
        border: 1px solid #ccc;
        margin-bottom: 20px;
    }


    .btn-primary {
    background-color: #FF6B6B;
    color: white;
    border-radius: 30px;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

.btn-primary:hover {
    background-color: #ff4f4f;
}


</style>

<section class="banner-area bg_cover">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="banner-content">
                    <h1 class="text-white">Edit Item</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="product-details-container">
    <div class="product-content">
        <h1 class="product-title">Edit Item</h1>
        <form action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $item->title }}" required>
            </div>

            <div class="form-group">
                <label for="subcategory_id">Subcategory:</label>
                <select name="subcategory_id" id="subcategory_id" class="form-control">
                    @foreach($subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}" {{ $item->subcategory_id == $subcategory->id ? 'selected' : '' }}>
                            {{ $subcategory->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-control" rows="4">{{ $item->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>

            <div class="form-group">
                <label for="show">Show in feed?</label>
                <select name="show" id="show" class="form-control">
                    <option value="active" {{ $item->show == 'active' ? 'selected' : '' }}>Yes</option>
                    <option value="inactive" {{ $item->show == 'inactive' ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <button type="submit" class="btn-primary">Update Item</button>
        </form>
    </div>
</div>
@endsection
