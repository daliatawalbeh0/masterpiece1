@extends('layouts.app')
@section('content')

<section class="banner-area bg_cover">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="banner-content">
                    <h1 class="text-white">Product Details</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Product</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="product-details-area">
    <div class="container">
        <div class="product-details-wrapper box-style d-flex flex-lg-row flex-column align-items-center justify-content-center">

            <!-- Image Wrapper -->
            <div class="image-wrapper">
                @if(!is_null($images = json_decode($item->image, true)))
        @foreach($images as $index => $image)
            <img src="{{ asset('storage/' . $image) }}" alt="{{ $item->title }}" class="product-image">
        @endforeach
    @else
        <p>No images available.</p>
    @endif

                <!-- Navigation Arrows -->
                <div class="nav-arrows">
                    <span class="prev-arrow">&#10094;</span>
                    <span class="next-arrow">&#10095;</span>
                </div>
            </div>

            <!-- Text Wrapper -->
            <div class="text-wrapper ml-lg-4 mt-4 mt-lg-0">
                <div class="mb-20 meta-top">
                    <a href="javascript:void(0)" class="mr-3 date"><i class="mr-2 lni lni-calendar"></i> {{ $item->created_at ? $item->created_at->format('Y-m-d') : 'Date not available' }}
</a>
                    <a href="javascript:void(0)" class="address"><i class="mr-2 lni lni-map-marker"></i> {{ $item->TheUser->address }}</a>
                </div>
                <h3 class="title mb-25">{{ $item->title }}</h3>
                <p class="description mb-30">{{ $item->description }}</p>

                <div class="meta-bottom">
                    <p>Owner: {{ $item->TheUser->name }}</p>
                    <p>Phone: {{ $item->TheUser->phone_number }}</p>

                    <a href="{{ route('chat', ['user_id' => $item->TheUser->id]) }}" class="btn btn-primary">Start Chat</a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Main Wrapper */
.product-details-wrapper {
    max-width: 1000px;
    margin: 50px auto;
    display: flex;
    background: white;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 20px;
    gap: 30px;
}

/* Image Wrapper */
.image-wrapper {
    position: relative;
    width: 50%;
    max-height: 400px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

.product-image {
    display: none;
    width: 100%;
    height: auto;
    object-fit: cover;
    transition: opacity 0.3s ease;
}

.product-image.active {
    display: block;
}

/* Navigation Arrows */
.nav-arrows {
    position: absolute;
    top: 50%;
    width: 100%;
    display: flex;
    justify-content: space-between;
    transform: translateY(-50%);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.image-wrapper:hover .nav-arrows {
    opacity: 1;
}

.nav-arrows span {
    background-color: rgba(255, 111, 111, 0.8);
    color: white;
    padding: 10px;
    cursor: pointer;
    font-size: 24px;
    border-radius: 50%;
    user-select: none;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.nav-arrows span:hover {
    background-color: #ff4040;
    transform: scale(1.2);
}

/* Text Wrapper */
.text-wrapper {
    flex: 1;
    padding: 20px;
}

.meta-top a {
    color: #888;
    text-decoration: none;
    font-size: 0.9rem;
}

.title {
    font-size: 1.5rem;
    font-weight: bold;
    color: #333;
}

.description {
    color: #666;
}

/* Button Styling */
.btn-primary {
    background-color: #ff6f6f;
    color: white;
    border: none;
    border-radius: 50px;
    padding: 10px 30px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-primary:hover {
    background-color: #ff4040;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('.product-image');
    const prevArrow = document.querySelector('.prev-arrow');
    const nextArrow = document.querySelector('.next-arrow');
    let currentIndex = 0;

    function showImage(index) {
        images.forEach((img, i) => {
            img.classList.toggle('active', i === index);
        });
    }

    prevArrow.addEventListener('mouseenter', function() {
        currentIndex = (currentIndex > 0) ? currentIndex - 1 : images.length - 1;
        showImage(currentIndex);
    });

    nextArrow.addEventListener('mouseenter', function() {
        currentIndex = (currentIndex < images.length - 1) ? currentIndex + 1 : 0;
        showImage(currentIndex);
    });
});
</script>

@endsection
