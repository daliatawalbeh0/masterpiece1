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

<!--====== BANNER PART START ======-->
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
<!--====== BANNER PART END ======-->

<!--====== DASHBOARD PART START ======-->
<section class="dashboard-area pb-110">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <div class="left-sidebar-wrapper box-style">
                    <div class="sidebar-header">
                        <div class="image">
                            <img src="assets/images/dashboard/profile-img.png" alt="">
                        </div>
                        <div class="info">
                            @if(Auth::check())
                            <h3>{{ Auth::user()->name }}</h3>
                        @endif

                            <p class="mb-30">Director at Uideck.com</p>
                        </div>
                    </div>

                    <div class="sidebar-menu">
                        <nav>
                            <ul>
                                <li>
                                    <a href="{{ route('userdashboard') }}" class="active"><i class="lni lni-dashboard"></i>Dashboard</a>
                                </li>

                                {{-- <li>
                                    <a href="{{ route('userprofilesetting', Auth::id()) }}">Profile Settings</a>

                                </li> --}}
                                <li>
                                    <a href="{{ route('postad') }}"><i class="lni lni-cog"></i>Post Ad</a>
                                </li>


                                <li>
                                    <a href="{{ route('userdashboard') }}"><i class="lni lni-layers"></i>My Ads</a>
                                </li>

                                <li>
                                    <a href="{{ route('messages.index') }}"><i class="lni lni-envelope"></i>Offers / Message</a>
                                </li>



                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="lni lni-exit"></i>Sign Out
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                        <button type="submit">Logout</button>
                                    </form>

                                </li>

                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="col-xl-9 col-lg-8">
                <div class="post-ad-wrapper box-style">
                    <div class="title">
                        <h3>Post Ad</h3>
                    </div>

                    <div class="post-ad-form-wrapper">
                        <form action="{{ route('productSuggestions') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-xl-7">
                                    <div class="left-wrapper pt-50">
                                        <h5 class="mb-25">Ad Details</h5>

                                        <div class="single-form mb-15">
                                            <label for="title" class="mb-1">Product Name</label>
                                            <input type="text" id="title" name="title" placeholder="Title" class="px-3 py-2 mb-0 border rounded">
                                        </div>

                                        <div class="single-form mb-15">
                                            <label for="category" class="mb-1">Category</label>
                                            <select name="category_id" id="category" class="px-3 py-2 border rounded w-100">
                                                <option value="" selected>Select category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="single-form mb-15">
                                            <label for="subcategory" class="mb-1">Subcategory</label>
                                            <select name="subcategory_id" id="subcategory" class="px-3 py-2 border rounded w-100">
                                                <option value="" selected>Select subcategory</option>
                                            </select>
                                        </div>

                                        <div class="single-form mb-15">
                                            <label for="condition" class="mb-1">Condition</label>
                                            <select name="condition" id="condition" class="px-3 py-2 border rounded w-100">
                                                <option value="new">New</option>
                                                <option value="used">Used</option>
                                            </select>
                                        </div>

                                        <div class="single-form mb-15">
                                            <label for="duration" class="mb-1">Usage Duration in months "if it is used"</label>
                                            <input type="text" id="duration" name="usage_duration" placeholder="Duration" class="px-3 py-2 mb-0 border rounded">
                                        </div>

                                        <div class="single-form mb-15">
                                            <label for="price" class="mb-1">Original Price</label>
                                            <input type="text" id="price" name="price" placeholder="Price" class="px-3 py-2 mb-0 border rounded">
                                        </div>

                                        <!-- الحقول المتعلقة بالتبادل -->
                                        <div id="exchange_fields">
                                            <div class="single-form mb-15">
                                                <label for="want_specific_item">Do you want a specific item in exchange?</label><br>
                                                <input type="radio" name="want_specific_item" id="yes" value="yes" onchange="toggleItemSelection(true)">
                                                <label for="yes">Yes</label>
                                                <input type="radio" name="want_specific_item" id="no" value="no" checked onchange="toggleItemSelection(false)">
                                                <label for="no">No</label>
                                            </div>

                                            <div id="specific_item_fields" style="display: none;">
                                                <div class="single-form mb-15">
                                                    <label for="desired_item_category" class="mb-1">Desired Item Category</label>
                                                    <select name="desired_item_category" id="desired_item_category" class="px-3 py-2 border rounded w-100">
                                                        <option value="" selected>Select desired category</option>
                                                        @foreach($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="single-form mb-15">
                                                    <label for="desired_item_subcategory" class="mb-1">Desired Item Subcategory</label>
                                                    <select name="desired_item_subcategory" id="desired_item_subcategory" class="px-3 py-2 border rounded w-100">
                                                        <option value="" selected>Select desired subcategory</option>
                                                    </select>
                                                </div>

                                                <div class="single-form mb-15">
                                                    <label for="desired_item_description" class="mb-1">Description of the Desired Item</label>
                                                    <textarea name="desired_item_description" id="desired_item_description" rows="5" placeholder="Describe the item you want in exchange" class="px-3 py-2 mb-0 border rounded"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="single-form mb-15">
                                            <label for="description" class="mb-1">Description</label>
                                            <textarea name="description" id="description" rows="5" placeholder="Description" class="px-3 py-2 mb-0 border rounded"></textarea>
                                        </div>

                                        <div class="single-form">
                                            <div class="upload-input">
                                                <input type="file" id="upload" name="images[]" multiple accept="image/*" required>
                                                <label for="upload" class="text-center content">
                                                    <span class="text">
                                                        <span class="d-block mb-15">Drop files anywhere to Upload</span>
                                                        <span class="d-block mb-15">Or</span>
                                                        <span class="main-btn btn-hover">Select File (3 files required)</span>
                                                        <span class="d-block">Maximum upload file size 10Mb each</span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>

                                        <script>
                                            document.getElementById('upload').addEventListener('change', function() {
                                                const files = this.files;
                                                if (files.length !== 3) {
                                                    alert('You must upload exactly 3 images.');
                                                    this.value = ''; // Clear the input
                                                }
                                            });
                                        </script>

                                    </div>
                                </div>
                            </div>
                            <button class="main-btn btn-hover">Post Ad</button>
                        </form>

                        <script>
                            // عرض أو إخفاء الحقول الخاصة بـ specific item
                            function toggleItemSelection(showFields) {
                                document.getElementById('specific_item_fields').style.display = showFields ? 'block' : 'none';
                            }
                        </script>

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // جلب subcategory بناءً على category عند اختيار الفئة المرغوبة
    $(document).ready(function() {
        $('#category').change(function() {
            var categoryId = $(this).val();

            if (categoryId) {
                $.ajax({
                    url: '/get-subcategories/' + categoryId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#subcategory').empty(); // إفراغ القائمة السابقة
                        $('#subcategory').append('<option value="">Select subcategory</option>'); // إضافة الخيار الافتراضي
                        $.each(data, function(key, value) {
                            $('#subcategory').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                $('#subcategory').empty();
                $('#subcategory').append('<option value="">Select subcategory</option>');
            }
        });

        $('#desired_item_category').change(function() {
            var desiredCategoryId = $(this).val();

            if (desiredCategoryId) {
                $.ajax({
                    url: '/get-subcategories/' + desiredCategoryId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#desired_item_subcategory').empty();
                        $('#desired_item_subcategory').append('<option value="">Select subcategory</option>');
                        $.each(data, function(key, value) {
                            $('#desired_item_subcategory').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                $('#desired_item_subcategory').empty();
                $('#desired_item_subcategory').append('<option value="">Select subcategory</option>');
            }
        });
    });
</script>

@endsection
