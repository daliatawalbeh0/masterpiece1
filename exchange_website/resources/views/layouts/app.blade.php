<!DOCTYPE html>
<head>
	<meta charset="utf-8">

	<!--====== Title ======-->
	<title>ClassiList Classified Ads Template</title>

	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!--====== Favicon Icon ======-->
	<link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/png">

	<!--====== Animate CSS ======-->
	<link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">

	<!--====== Tiny slider CSS ======-->
	<link rel="stylesheet" href="{{ asset('assets/css/tiny-slider.css') }}">

	<!--====== glightbox CSS ======-->
	<link rel="stylesheet" href="{{ asset('assets/css/glightbox.min.css') }}">

	<!--====== Line Icons CSS ======-->
	<link rel="stylesheet" href="{{ asset('assets/css/LineIcons.2.0.css') }}">

	<!--====== Selectr CSS ======-->
	<link rel="stylesheet" href="{{ asset('assets/css/selectr.css') }}">

	<!--====== Nouislider CSS ======-->
	<link rel="stylesheet" href="{{ asset('assets/css/nouislider.css') }}">

	<!--====== Bootstrap CSS ======-->
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-5.0.5-alpha.min.css') }}">

	<!--====== Style CSS ======-->
	<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Leaflet CSS (local asset) -->
    <link rel="stylesheet" href="{{ asset('css/leaflet/leaflet.css') }}" />

    <!-- Leaflet JavaScript (local asset) -->
    <script src="{{ asset('js/leaflet/leaflet.js') }}"></script>


</head>

<body>
@include('layouts.navbar')
<main>
    @yield('content')
</main>
@include('layouts.footer')

<!--====== BACK TOP TOP PART START ======-->
<a href="#" class="back-to-top btn-hover"><i class="lni lni-chevron-up"></i></a>
<!--====== BACK TOP TOP PART ENDS ======-->

<!--====== Bootstrap js ======-->
<script src="{{ asset('assets/js/bootstrap.bundle-5.0.0.alpha-min.js') }}"></script>

<!--====== Tiny slider js ======-->
<script src="{{ asset('assets/js/tiny-slider.js') }}"></script>

<!--====== wow js ======-->
<script src="{{ asset('assets/js/wow.min.js') }}"></script>

<!--====== glightbox js ======-->
<script src="{{ asset('assets/js/glightbox.min.js') }}"></script>

<!--====== Selectr js ======-->
<script src="{{ asset('assets/js/selectr.min.js') }}"></script>

<!--====== Nouislider js ======-->
<script src="{{ asset('assets/js/nouislider.js') }}"></script>

<!--====== Main js ======-->
<script src="{{ asset('assets/js/main.js') }}"></script>

<script>
    //========= glightbox
    const myGallery = GLightbox({
        'href': '{{ asset('assets/video/Free App Landing Page Template - AppLand.mp4') }}',
        'type': 'video',
        'source': 'youtube', //vimeo, youtube or local
        'width': 900,
        'autoplayVideos': true,
    });

    //======== tiny slider for feature-product-carousel
    tns({
        slideBy: 'page',
        autoplay: false,
        mouseDrag: true,
        gutter: 20,
        nav: false,
        controls: true,
        controlsPosition: 'bottom',
        controlsText: [
            '<span class="prev"><i class="lni lni-chevron-left"></i></span>',
            '<span class="next"><i class="lni lni-chevron-right"></i></span>'
        ],
        container: ".feature-product-carousel",
        items: 1,
        center: false,
        autoplayTimeout: 5000,
        swipeAngle: false,
        speed: 400,
        responsive: {
            768: {
                items: 2,
            },
            992: {
                items: 2,
            },
            1200: {
                items: 3,
            }
        }
    });

    //======== tiny slider for testimonial
    tns({
        slideBy: 'page',
        autoplay: false,
        mouseDrag: true,
        gutter: 20,
        nav: true,
        controls: false,
        container: ".testimonial-carousel",
        items: 1,
        center: false,
        autoplayTimeout: 5000,
        swipeAngle: false,
        speed: 400,
        responsive: {
            768: {
                items: 2,
            },
            1200: {
                items: 3,
            }
        }
    });
</script>
</body>
</html>
