@extends('layouts.app')

@section('content')
<!--====== BANNER PART START ======-->
<section class="banner-area bg_cover">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="banner-content">
                    <h1 class="text-white">Post Donation Ad</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Post Donation</li>
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

                                <li>
                                    <a href="{{ route('userprofilesetting', Auth::id()) }}">Profile Settings</a>

                                </li>
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
                        <h3>Post Donation Ad</h3>
                    </div>

                    <div class="post-ad-form-wrapper">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('user.store_donation') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-xl-7">
                                    <div class="left-wrapper pt-50">
                                        <h5 class="mb-25">Donation Details</h5>

                                        <div class="single-form mb-15">
                                            <label for="item_title" class="mb-1">Item Title</label>
                                            <input type="text" name="item_title" class="px-3 py-2 mb-0 border rounded" placeholder="Enter item title" required>
                                        </div>

                                        <div class="single-form mb-15">
                                            <label for="description" class="mb-1">Description</label>
                                            <textarea name="description" class="px-3 py-2 mb-0 border rounded" rows="5" placeholder="Enter item description" required></textarea>
                                        </div>

                                        <div class="single-form mb-15">
                                            <label for="image" class="mb-1">Upload Image</label>
                                            <input type="file" name="image" class="form-control" required>
                                        </div>

                                        <button type="submit" class="main-btn btn-hover">Post Donation</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--====== DASHBOARD PART END ======-->

@endsection
