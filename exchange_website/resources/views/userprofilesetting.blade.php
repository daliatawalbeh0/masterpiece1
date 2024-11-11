@extends('layouts.app')

@section('content')
<section class="banner-area bg_cover">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="banner-content">
                    <h1 class="text-white">Profile Settings</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

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
                        <h3>Edit Profile</h3>
                    </div>

                    <div class="post-ad-form-wrapper">
                        <form action="{{ route('user.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-xl-7">
                                    <div class="right-wrapper pt-50">
                                        <h5 class="mb-25">Edit Profile</h5>

                                        <div class="single-form mb-15">
                                            <label for="name" class="mb-1">Name</label>
                                            <input type="text" id="name" name="name" placeholder="Name" class="px-3 py-2 mb-0 border rounded" value="{{ $user->name }}" required>
                                        </div>

                                        <div class="single-form mb-15">
                                            <label for="email" class="mb-1">Email</label>
                                            <input type="email" id="email" name="email" placeholder="Email" class="px-3 py-2 mb-0 border rounded" value="{{ $user->email }}" required>
                                        </div>

                                        <div class="single-form mb-15">
                                            <label for="old_password" class="mb-1">Old Password</label>
                                            <input type="password" id="old_password" name="old_password" placeholder="Old Password" class="px-3 py-2 mb-0 border rounded">
                                        </div>

                                        <div class="single-form mb-15">
                                            <label for="password" class="mb-1">New Password</label>
                                            <input type="password" id="password" name="password" placeholder="New Password" class="px-3 py-2 mb-0 border rounded">
                                        </div>

                                        <div class="single-form mb-15">
                                            <label for="phone" class="mb-1">Phone*</label>
                                            <input type="text" id="phone" name="phone" placeholder="Phone" class="px-3 py-2 mb-0 border rounded" value="{{ $user->phone }}" required>
                                        </div>

                                        <div class="single-form mb-15">
                                            <label for="address" class="mb-1">Address</label>
                                            <input type="text" id="address" name="address" placeholder="Enter Address" class="px-3 py-2 mb-0 border rounded" value="{{ $user->address }}">
                                        </div>

                                        <div class="single-form mb-15">
                                            <label for="city" class="mb-1">City</label>
                                            <select name="city" id="city" class="px-3 py-2 border rounded w-100">
                                                <option value="Amman" {{ $user->city == 'Amman' ? 'selected' : '' }}>Amman</option>
                                                <option value="Zarqa" {{ $user->city == 'Zarqa' ? 'selected' : '' }}>Zarqa</option>
                                                <!-- Add more cities as needed -->
                                            </select>
                                        </div>

                                        <button class="main-btn btn-hover">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @if (session('success'))
                            <div class="alert alert-success mt-3">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
