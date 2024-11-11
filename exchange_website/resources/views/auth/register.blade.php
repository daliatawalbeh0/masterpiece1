
@extends('layouts.app')
@section('content')



	<!--====== BANNER PART START ======-->
	<section class="banner-area bg_cover">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="banner-content">
						<h1 class="text-white">Sign Up Page</h1>
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.html">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Sign up Page</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--====== BANNER PART END ======-->

	<!--====== 404 PRODUCT PART START ======-->
	<section class="login-area pt-70 pb-70">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6 col-md-10">
					<div class="login-wrapper box-style">
						<h3 class="mb-20">Sign Up</h3>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="single-form mb-20">
                                        <label for="name" class="mb-2">Name</label>
                                        <input type="text" id="name" name="name" placeholder="Name" class="py-2 px-3 mb-0 rounded border" required>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="single-form mb-20">
                                        <label for="email" class="mb-2">Email</label>
                                        <input type="email" id="email" name="email" placeholder="Email" class="py-2 px-3 mb-0 rounded border" required>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="single-form mb-20">
                                        <label for="password" class="mb-2">Password</label>
                                        <input type="password" id="password" name="password" placeholder="Password" class="py-2 px-3 mb-0 rounded border" required>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="single-form mb-20">
                                        <label for="password_confirmation" class="mb-2">Confirm Password</label>
                                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" class="py-2 px-3 mb-0 rounded border" required>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="single-form mb-20">
                                        <label for="phone_number" class="mb-2">Phone Number</label>
                                        <input type="text" id="phone_number" name="phone_number" placeholder="Phone Number" class="py-2 px-3 mb-0 rounded border" required>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="single-form mb-20">
                                        <label for="address" class="mb-2">Address</label>
                                        <input type="text" id="address" name="address" placeholder="Address" class="py-2 px-3 mb-0 rounded border" required>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="single-form mb-30">
                                        <button class="main-btn btn-hover py-2 px-5 rounded">Sign Up</button>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="single-form mb-30">
                                        <p>Have an Account? <a href="{{ route('login') }}">Login</a></p>
                                    </div>
                                </div>
                            </div>
                        </form>


					</div>
				</div>
			</div>
		</div>
	</section>
	<!--====== 404 PRODUCT PART ENDS ======-->
@endsection
