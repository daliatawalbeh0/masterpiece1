@extends('layouts.app')
@section('content')

<!--====== BANNER PART START ======-->
<section class="banner-area bg_cover">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="banner-content">
                    <h1 class="text-white">All Categories</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Category</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!--====== BANNER PART END ======-->

<!--====== CATEGORY PART START ======-->
<section class="category-area pb-110">
    <div class="container">
        <!-- category top -->
        <div class="category-top box-style">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="left-wrapper">
                        <div class="sorting">
                            <label for="sort">Show items</label>
                            <form action="{{ route('categories.display') }}" method="GET">
                                <select name="sort" id="sort" onchange="this.form.submit()">
                                    <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Popular Items</option>
                                    <option value="default" {{ request('sort') == 'default' ? 'selected' : '' }}>By Default</option>
                                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest Items</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right-wrapper">
                        <form action="{{ route('categories.display') }}" method="GET">
                            <input type="text" name="search" id="search" placeholder="Search" value="{{ request('search') }}">
                            <button type="submit"><i class="lni lni-search-alt"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content and sidebar wrapper -->
        <div class="row">
            <!-- Items section (left side) -->
            <div class="col-lg-8">
                <div class="left-wrapper">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="grid" role="tabpanel" aria-labelledby="grid-tab">
                            <div class="row">
                                @foreach($items as $item)
                                <div class="col-lg-6 col-md-6 product-item">
                                    <div class="single-product animated-product">
                                        <div class="product-img">
                                            <a href="{{ route('itemdetails', $item->id) }}">
                                                <img src="{{ asset('storage/' . $item->image) }}" alt="">
                                            </a>
                                            <div class="product-action">
                                                <a href="javascript:void(0)"><i class="lni lni-heart"></i></a>
                                                <a href="javascript:void(0)" class="share"><i class="lni lni-share"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h3 class="name">
                                                <a href="{{ route('itemdetails', $item->id) }}">{{ $item->title }}</a>
                                            </h3>
                                            <span class="update">Last Update: {{ $item->created_at ? $item->created_at->diffForHumans() : 'Date not available' }}</span>
                                            <ul class="address-grid">
                                                <li>
                                                    <a href="javascript:void(0)"><i class="lni lni-map-marker"></i> {{ $item->TheUser->address }}</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)"><i class="lni lni-user"></i> {{ $item->TheUser->name }}</a>
                                                </li>
                                                <li>
                                                    <a href="tel:{{ $item->TheUser->phone_number }}"><i class="lni lni-phone"></i> {{ $item->TheUser->phone_number }}</a>
                                                </li>
                                                <li>
                                                    <a href="https://wa.me/{{ $item->TheUser->phone_number }}" target="_blank"><i class="lni lni-whatsapp"></i> WhatsApp</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)"><i class="lni lni-package"></i> {{ $item->condition }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="list" role="tabpanel" aria-labelledby="list-tab">
                            <!-- List view content (if needed) -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar section (right side) -->
            <div class="col-lg-4">
                <div class="sidebar-wrapper">
                    <!-- sidebar category -->
                    <div class="box-style sidebar-category">
                        <h3 class="mb-30">All Categories</h3>
                        <ul>
                            @foreach($categories as $category)
                            <li>
                                <a href="{{ route('categories.display', ['category' => $category->id]) }}">
                                    <span>{{ $category->name }}</span>
                                    <span class="right">
                                        {{ $category->subcategories->sum(function($subcategory) {
                                            return $subcategory->items->count();
                                        }) }}
                                    </span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- add box -->
                    <!-- Any additional sidebar content can be added here -->
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CSS for New Style and Animation -->
<style>
    /* Basic styling for product items */
    .single-product {
        position: relative;
        background-color: #fff;
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
    }

    /* Fade-in animation for product items */
    .animated-product {
        opacity: 0;
        transform: translateY(30px);
        animation: fadeInUp 0.6s forwards;
        animation-delay: calc(0.1s * var(--animation-order));
    }

    /* Define fade-in animation */
    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Product image hover effect */
    .product-img img {
        width: 100%;
        transition: transform 0.3s ease;
    }

    .single-product:hover .product-img img {
        transform: scale(1.1);
    }

    /* Product actions styling */
    .product-action {
        position: absolute;
        top: 15px;
        right: 15px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .single-product:hover .product-action {
        opacity: 1;
    }

    .product-action a {
        background-color: rgba(0, 0, 0, 0.6);
        color: #fff;
        padding: 6px;
        border-radius: 50%;
    }

    .product-content {
        padding: 20px;
        text-align: center;
    }

    .product-content .name a {
        font-weight: bold;
        color: #333;
        text-decoration: none;
    }

    .product-content .name a:hover {
        color: #007bff;
    }

    .product-content .update {
        display: block;
        font-size: 0.9rem;
        color: #888;
        margin-top: 8px;
    }

    /* Grid styling for address list */
    .address-grid {
        list-style: none;
        padding: 0;
        margin: 10px 0 0 0;
        display: grid;
        grid-template-columns: 1fr 1fr; /* Two columns for side-by-side layout */
        gap: 10px; /* Adjust spacing between items */
    }

    .address-grid li {
        display: flex;
        align-items: center;
        color: #555;
    }

    .address-grid li a {
        color: #555;
        font-size: 0.9rem;
        text-decoration: none;
        display: flex;
        align-items: center;
    }

    .address-grid li a i {
        margin-right: 5px;
    }

    .address-grid li a:hover {
        color: #007bff;
    }
</style>

<!-- Script to add delay to each product item for the animation effect -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const productItems = document.querySelectorAll('.product-item');
        productItems.forEach((item, index) => {
            item.style.setProperty('--animation-order', index);
        });
    });
</script>




<!--====== CATEGORY PART END ======-->

@endsection
