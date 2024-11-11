@extends('layouts.app')
@section('content')

	<section class="banner-area bg_cover">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="banner-content">
						<h1 class="text-white">Login Page</h1>
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.html">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Login Page</li>
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
						<h3 class="mb-20">Login</h3>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
							<div class="row">
								<div class="col-12">
									<div class="single-form mb-20">
										<label for="email" class="mb-2">Email Or Username</label>
										<input type="text" id="email" name="email" placeholder="Email Or Username" class="py-2 px-3 mb-0 rounded border">
									</div>
								</div>
								<div class="col-12">
									<div class="single-form mb-20">
										<label for="password" class="mb-2">Password</label>
										<input type="password" id="password" name="password" placeholder="Password" class="py-2 px-3 mb-0 rounded border">
									</div>
								</div>
								<div class="col-12">
									<div class="single-form mb-30">
										<button class="main-btn btn-hover py-2 px-5 rounded">Login</button>
									</div>
								</div>

								<div class="col-12">
									<div class="single-form mb-30">
										<p>Don't have an Account? <a href="{{route('register')}}">Sign up</a></p>
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
