

@extends('layouts.app')
@section('content')



	<!--====== HEADER PART ENDS ======-->

	<!--====== HERO PART START ======-->
	<section id="home" class="hero-area bg_cover">
		<div class="container">
			<div class="row">
				<div class="mx-auto col-lg-7 col-xl-6 col-md-10">
					<div class="text-center hero-content">
						<h1 class="mb-30 wow fadeInUp" data-wow-delay=".2s">Welcome to ClassList</h1>
						<p class="wow fadeInUp" data-wow-delay=".4s">Buy and sell everything from used cars to mobile phones and computer or search for property, job and more</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--====== HERO PART END ======-->

	<!--====== SEARCH PART START ======-->
    <div class="search-area">
        <div class="container">
            <div class="search-wrapper">
                <form action="{{ route('category.index') }}" method="GET">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 col-sm-5 col-10">
                            <div class="search-input">
                                <label for="keyword"><i class="lni lni-search-alt theme-color"></i></label>
                                <input type="text" name="keyword" id="keyword" placeholder="Product keyword">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-5 col-10">
                            <div class="search-input">
                                <label for="category"><i class="lni lni-grid-alt theme-color"></i></label>
                                <select name="category" id="category">
                                    <option value="" selected>Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-5 col-10">
                            <div class="search-input">
                                <label for="address"><i class="lni lni-map-marker theme-color"></i></label>
                                <select name="address" id="address">
                                    <option value="" selected>City</option>
                                    <!-- Add actual locations here -->
                                    <option value="Amman">Amman</option>
                                    <option value="Irbid">Irbid</option>
                                    <option value="Zarqa">Zarqa</option>
                                    <option value="Zarqa">Jarash</option>
                                    <option value="Zarqa">Aqaba</option>
                                    <option value="Zarqa">Salt</option>
                                    <option value="Zarqa">Mafraq</option>
                                    <option value="Zarqa">Ma'an</option>
                                    <option value="Zarqa">Ajloun</option>
                                    <option value="Zarqa">Altafila</option>
                                    <option value="Zarqa">Madaba</option>
                                    <option value="Zarqa">Alkarak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-5 col-10">
                            <div class="search-btn">
                                <button class="main-btn btn-hover" type="submit">Search <i class="lni lni-search-alt"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



	<!--====== SEARCH PART END ======-->

	<!--====== CATEGORY LIST PART START ======-->
   <section class="category-list-area pt-130">
    <div class="container">
        <div class="text-center section-title mb-60">
            <h1>Categories</h1>
            <br>
            <div class="category-list-wrapper d-flex justify-content-center flex-wrap">
                @foreach($categories as $category)
                <div class="category-list-item" style="--animation-order: {{ $loop->index }}">
                    <form method="GET" action="{{ route('category.show') }}">
                        <input type="hidden" name="category_id" value="{{ $category->id }}">
                        <button type="submit" class="category-button">
                            <div class="icon">
                                @if($category->name == 'Electronics')
                                    <i class="fas fa-tv"></i>
                                @elseif($category->name == 'Furniture')
                                    <i class="fas fa-couch"></i>
                                @elseif($category->name == 'Vehicles')
                                    <i class="fas fa-car"></i>
                                @elseif($category->name == 'Mobiles')
                                    <i class="fas fa-mobile-alt"></i>
                                @elseif($category->name == 'Fashion')
                                    <i class="fas fa-tshirt"></i>
                                @endif
                            </div>
                            <h3>{{ $category->name }}</h3>
                        </button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- CSS for Enhanced Styling with Increased Spacing -->
<style>
    .category-list-wrapper {
        display: flex;
        gap: 30px; /* Space between items */
        flex-wrap: wrap;
        justify-content: center;
    }

    .category-list-item {
        flex: 1 1 180px;
        max-width: 180px;
        margin: 20px; /* Additional space around each item */
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .category-button {
        background-color: #fff;
        border: 2px solid #ddd;
        border-radius: 10px;
        padding: 20px;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        transition: background-color 0.3s ease, border-color 0.3s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .category-button .icon {
        font-size: 2rem;
        color: #ff5a5f;
        margin-bottom: 10px;
    }

    .category-button h3 {
        font-size: 1rem;
        color: #333;
        margin: 0;
    }

    .category-button:hover {
        background-color: #ff5a5f;
        border-color: #ff5a5f;
        color: #fff;
    }

    .category-button:hover h3, .category-button:hover .icon {
        color: #fff;
    }

    /* Styling the active category button */
    .category-list-item.active .category-button {
        background-color: #ff5a5f;
        color: #fff;
    }
</style>

<!-- Include Font Awesome if not included -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

        <section class="how-it-works py-5">
    <div class="container">
        <h2 class="text-center mb-5">How It Works</h2>
        <div class="row text-center">
            <!-- Step 1: Find an Item -->
            <div class="col-md-3 mb-4">
                <div class="icon mb-3">
                    <i class="lni lni-search-alt theme-color" style="font-size: 36px;"></i>
                </div>
                <h5>Find an Item</h5>
                <p>Browse our categories to find the perfect match.</p>
            </div>
            <!-- Step 2: Chat & Confirm -->
            <div class="col-md-3 mb-4">
                <div class="icon mb-3">
                    <i class="lni lni-comments-alt theme-color" style="font-size: 36px;"></i>
                </div>
                <h5>Chat & Confirm</h5>
                <p>Chat live with the item owner to discuss details.</p>
            </div>
            <!-- Step 3: Admin Approval -->
            <div class="col-md-3 mb-4">
                <div class="icon mb-3">
                    <i class="lni lni-shield theme-color" style="font-size: 36px;"></i>
                </div>
                <h5>Admin Approval</h5>
                <p>Our team reviews and approves safe exchanges.</p>
            </div>
            <!-- Step 4: Donate Items -->
            <div class="col-md-3 mb-4">
                <div class="icon mb-3">
                    <i class="lni lni-heart theme-color" style="font-size: 36px;"></i>
                </div>
                <h5>Donate Items</h5>
                <p>Support those in need by donating items.</p>
            </div>
        </div>
    </div>
</section>

<style>
    .how-it-works .icon {
        color: #ff6b6b;
    }
    .how-it-works h5 {
        font-size: 18px;
        font-weight: bold;
        color: #333;
        margin-top: 10px;
    }
    .how-it-works p {
        font-size: 14px;
        color: #666;
    }
</style>


	<!--====== CATEGORY LIST PART END ======-->

	<!--====== LATEST PRODUCT PART START ======-->
<section class="latest-product-area pt-130 pb-110">
    <div class="container">
        <div class="row">
            <div class="mx-auto col-xl-6 col-lg-7 col-md-10">
                <div class="text-center section-title mb-60">
                    <h1>Latest Exchange Items</h1>
                    <p>Check out the latest items available for exchange.</p>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($exchangeItems as $item)
            <div class="col-lg-6 col-md-6 product-item">
                <div class="single-product animated-product">
                    <div class="product-img">
                        <a href="{{ route('itemdetails', $item->id) }}">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
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
                        <span class="update">Last Update: {{ $item->created_at ? $item->created_at->diffForHumans() : 'Date not available' }}
</span>
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
                                <a href="javascript:void(0)"><i class="lni lni-package"></i> {{ ucfirst($item->condition) }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            <a href="{{ route('category') }}" class="btn btn-primary btn-hover">View All</a>
        </div>
    </div>
</section>

<!-- Updated Styling -->
<style>
/* Main button styling */
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

/* Product items and animation */
.single-product {
    position: relative;
    background-color: #fff;
    border-radius: 8px;
    overflow: hidden;
    transition: transform 0.3s, box-shadow 0.3s;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 30px;
}

.animated-product {
    opacity: 0;
    transform: translateY(30px);
    animation: fadeInUp 0.6s forwards;
    animation-delay: calc(0.1s * var(--animation-order));
}

@keyframes fadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Flex container for product items */
.row {
    display: flex;
    flex-wrap: nowrap; /* Keeps all items in the same line without wrapping */
    gap: 20px; /* Space between cards */
    justify-content: space-between; /* Distributes items evenly in the container */
}

/* Card styling */
.col-lg-6, .col-md-6 {
    flex: 1 0 30%; /* Ensures three items per row */
    max-width: 30%; /* Keeps width constrained for three items per row */
    margin-bottom: 20px;
}

/* Flexbox to keep three items in the same line */
.product-item {
    width: 100%;
}

/* Responsive behavior for smaller screens */
@media (max-width: 991px) {
    .col-lg-6, .col-md-6 {
        flex: 1 0 45%; /* Two items per row on medium screens */
        max-width: 45%;
    }
}

@media (max-width: 767px) {
    .col-lg-6, .col-md-6 {
        flex: 1 0 100%; /* Single item per row on smaller screens */
        max-width: 100%;
    }
}

/* Product image */
.product-img {
    position: relative;
    text-align: center;
}

.product-img img {
    width: 100%;
    border-radius: 8px 8px 0 0;
    transition: transform 0.3s ease;
}

.single-product:hover .product-img img {
    transform: scale(1.05);
}

/* Product action buttons */
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

/* Product content */
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

/* Address grid */
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

<!-- Script to add delay for each product item animation -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const productItems = document.querySelectorAll('.product-item');
        productItems.forEach((item, index) => {
            item.style.setProperty('--animation-order', index);
        });
    });
</script>



	<!--====== LATEST PRODUCT PART ENDS ======-->

	<!--====== FAQ ======-->
<section class="faq-section">
    <h2>Frequently Asked Questions</h2>

    <div class="faq-item">
        <button class="faq-question">How do I create a listing?</button>
        <div class="faq-answer">
            <p>To create a listing, log in to your account, go to the “Create Listing” section, and fill out the required details about your item. Make sure to add images and a detailed description to attract more buyers.</p>
        </div>
    </div>

    <div class="faq-item">
        <button class="faq-question">Can I edit or delete my listing after it has been posted?</button>
        <div class="faq-answer">
            <p>Yes, you can edit or delete your listing anytime. Go to your profile, navigate to "My Listings," select the listing you want to edit or delete, and follow the instructions provided.</p>
        </div>
    </div>

    <div class="faq-item">
        <button class="faq-question">How do I contact a seller?</button>
        <div class="faq-answer">
            <p>You can contact a seller by visiting their listing page and clicking on the “Contact Seller” button. You’ll be able to send a message directly to the seller and receive replies in your messages inbox.</p>
        </div>
    </div>

    <!-- Repeat the above structure for additional questions and answers -->
</section>
<style>/* FAQ Section Styling */
/* FAQ Section Styling */
.faq-section {
    max-width: 800px;
    margin: 40px auto;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.faq-section h2 {
    text-align: center;
    font-size: 1.8em;
    margin-bottom: 30px;
    color: #333;
    font-weight: 600;
}

.faq-item {
    margin-bottom: 15px;
    border-bottom: 1px solid #ddd;
    padding-bottom: 10px;
}

.faq-question {
    width: 100%;
    padding: 15px;
    background-color: #f8f9fa;
    color: #333;
    font-size: 1.1em;
    font-weight: 500;
    border: none;
    text-align: left;
    cursor: pointer;
    border-radius: 8px;
    outline: none;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.faq-question:hover {
    background-color: #007bff;
    color: #fff;
}

.faq-answer {
    padding: 15px;
    display: none; /* Hide the answer by default */
    background-color: #f1f1f1;
    border-radius: 8px;
    margin-top: 5px;
    font-size: 1em;
    color: #555;
    line-height: 1.6;
}

/* Adjust spacing between items */
.faq-item + .faq-item {
    margin-top: 10px;
}

</style>
<script>
    // Select all question buttons
    const questions = document.querySelectorAll('.faq-question');

    questions.forEach(question => {
        question.addEventListener('click', () => {
            // Find the associated answer element
            const answer = question.nextElementSibling;

            // Toggle answer visibility
            answer.style.display = answer.style.display === 'block' ? 'none' : 'block';

            // Close all other answers
            questions.forEach(q => {
                if (q !== question) {
                    q.nextElementSibling.style.display = 'none';
                }
            });
        });
    });
</script>


    {{-- <section class="donation-product-area pt-130 pb-110">
        <div class="container">
            <div class="row">
                <div class="mx-auto col-xl-6 col-lg-7 col-md-10">
                    <div class="text-center section-title mb-60">
                        <h1>Donation Items</h1>
                        <p>Check out the items available for donation.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach($donationItems as $item)
                                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="single-product">
                        <div class="product-img">
                            <h3>{{ $item->title }}</h3>
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                            <div class="product-action">
                                <a href="javascript:void(0)"><i class="lni lni-heart"></i></a>
                                <a href="javascript:void(0)" class="share"><i class="lni lni-share"></i></a>
                            </div>
                        </div>
                        <div class="product-content">
                            <a href="{{ route('itemdetails', ['id' => $item->id]) }}">Preview this item</a>
                            <ul class="address">
                                <li>
                                    <a href="javascript:void(0)"><i class="lni lni-map-marker"></i> {{ $item->TheUser->address }}</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><i class="lni lni-user"></i> {{ $item->TheUser->name }}</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><i class="lni lni-phone"></i> {{ $item->TheUser->phone_number }}</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><i class="lni lni-package"></i> {{ ucfirst($item->condition) }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach

            </div>
        </div>
    </section> --}}

	<!--====== VIDEO PART ENDS ======-->


<section class="features-section text-center mt-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="feature-item">
                    <span class="icon">🟢</span>
                    <h5>Secure Item Exchange</h5>
                    <p>Trade items safely with our secure platform.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="feature-item">
                    <span class="icon">🟢</span>
                    <h5>Admin-Approved Deals</h5>
                    <p>All exchanges are reviewed and approved by our team.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="feature-item">
                    <span class="icon">🟢</span>
                    <h5>Direct Chat with Traders</h5>
                    <p>Communicate directly with item owners in real-time.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="feature-item">
                    <span class="icon">🟢</span>
                    <h5>Donate to Charity</h5>
                    <p>Support those in need by donating items.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .features-section {
        padding-top: 20px;
        padding-bottom: 20px;
    }
    .feature-item {
        text-align: center;
    }
    .feature-item .icon {
        font-size: 24px;
        display: block;
        margin-bottom: 8px;
    }
    .feature-item h5 {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 5px;
        color: #333;
    }
    .feature-item p {
        font-size: 14px;
        color: #666;
    }
</style>

<section class="suggested-product-area pt-130 pb-110">
    <div class="container">
        <div class="row">
            <div class="mx-auto col-xl-6 col-lg-7 col-md-10">
                <div class="text-center section-title mb-60">
                    <h1>Suggested Items For You</h1>
                    <p>Check out the items available for you</p>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($suggestedItems as $item)
            <div class="col-lg-4 col-md-6 product-item">
                <div class="single-product animated-product">
                    <div class="product-img">
                        <a href="{{ route('itemdetails', $item->id) }}">
                            <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" alt="{{ $item->title }}">
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
                        <span class="update">Last Update: {{ $item->created_at ? $item->created_at->diffForHumans() : 'Date not available' }}
</span>
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
                        </ul>

                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            <a href="{{ route('productSuggestions') }}" class="btn btn-primary btn-hover">View All</a>
        </div>
    </div>
</section>

<!-- CSS -->
<style>
/* Main button styling */
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

.btn-sm {
    padding: 8px 20px;
    font-size: 14px;
}

/* Product items and animation */
.single-product {
    position: relative;
    background-color: #fff;
    border-radius: 8px;
    overflow: hidden;
    transition: transform 0.3s, box-shadow 0.3s;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 30px;
}

.animated-product {
    opacity: 0;
    transform: translateY(30px);
    animation: fadeInUp 0.6s forwards;
    animation-delay: calc(0.1s * var(--animation-order));
}

@keyframes fadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Product image */
.product-img {
    position: relative;
    text-align: center;
}

.product-img img {
    width: 100%;
    border-radius: 8px 8px 0 0;
    transition: transform 0.3s ease;
}

.single-product:hover .product-img img {
    transform: scale(1.05);
}

/* Product action buttons */
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

/* Product content */
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

/* Address grid */
.address-grid {
    list-style: none;
    padding: 0;
    margin: 10px 0 0 0;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
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

<!-- Script to add animation delay for each item -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const productItems = document.querySelectorAll('.product-item');
    productItems.forEach((item, index) => {
        item.style.setProperty('--animation-order', index);
    });
});
</script>




@endsection
