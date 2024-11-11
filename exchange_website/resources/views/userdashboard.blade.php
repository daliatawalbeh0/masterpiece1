

@extends('layouts.app')
@section('content')

	<!--====== BANNER PART START ======-->
	<section class="banner-area bg_cover">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="banner-content">
						<h1 class="text-white"> Dashboard </h1>
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.html">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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
					<div class="dashboard-wrapper box-style">
						<div class="title">
							<h3>Overview</h3>
							<span class="main-btn">Last 15 Days</span>
						</div>
                        <div class="cards-wrapper">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="box-style single-card">
                                        <div class="icon">
                                            <i class="lni lni-notepad"></i>
                                        </div>
                                        <div class="text">
                                            <h5>Approved Donation Ads</h5>
                                            <p>{{ $totalDonationAds }} Ads Posted</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="box-style single-card">
                                        <div class="icon">
                                            <i class="lni lni-add-files"></i>
                                        </div>
                                        <div class="text">
                                            <h5>Approved Exchange Ads</h5>
                                            <p>{{ $totalExchangeAds }} Ads Posted</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="box-style single-card">
                                        <div class="icon">
                                            <i class="lni lni-envelope"></i>
                                        </div>
                                        <div class="text">
                                            <h5>Total Messages </h5>
                                            <h5>for you</h5>
                                            <p>{{ $totalMessages }} Messages</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <style>
                            .table-wrapper {
                                background: #fff;
                                padding: 20px;
                                border-radius: 8px;
                                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                            }

                            .table-wrapper h3 {
                                margin-bottom: 20px;
                                color: #333;
                            }

                            .table {
                                width: 100%;
                                border-collapse: separate;
                                border-spacing: 0 10px;
                            }

                            .table th {
                                background-color: #f8f9fa;
                                padding: 12px;
                                text-align: left;
                                font-weight: 600;
                                color: #495057;
                            }

                            .table td {
                                padding: 12px;
                                vertical-align: middle;
                                background-color: #fff;
                                border-top: 1px solid #dee2e6;
                            }

                            .table tr:hover {
                                background-color: #f8f9fa;
                            }

                            .image img {
                                border-radius: 4px;
                                object-fit: cover;
                            }

                            .status-pending {
                                color: #ffc107;
                                font-weight: 600;
                            }

                            .status-approved {
                                color: #28a745;
                                font-weight: 600;
                            }

                            .status-rejected {
                                color: #dc3545;
                                font-weight: 600;
                            }

                            .action-btns {
                                display: flex;
                                gap: 10px;
                            }

                            .action-btns a {
                                padding: 5px 10px;
                                border-radius: 4px;
                                color: #fff;
                                text-decoration: none;
                                transition: background-color 0.3s;
                            }

                            .eye-btn { background-color: #17a2b8; }
                            .edit-btn { background-color: #ffc107; }
                            .delete-btn { background-color: #dc3545; }

                            .action-btns a:hover {
                                opacity: 0.8;
                            }

                            .pagination-wrapper {
                                display: flex;
                                justify-content: center;
                                margin-top: 20px;
                            }

                            .pagination {
                                display: flex;
                                list-style: none;
                                padding: 0;
                                gap: 5px;
                            }

                            .pagination li {
                                display: inline-block;
                            }

                            .pagination li a, .pagination li span {
                                padding: 8px 12px;
                                border: 1px solid #dee2e6;
                                color: #007bff;
                                text-decoration: none;
                                border-radius: 4px;
                                transition: background-color 0.3s;
                            }

                            .pagination li.active span {
                                background-color: #007bff;
                                color: #fff;
                                border-color: #007bff;
                            }

                            .pagination li a:hover {
                                background-color: #e9ecef;
                            }
                            </style>

                            <div class="table-wrapper table-responsive">
                                <h3>All Items</h3>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Photo</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Ad Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($paginatedItems as $item)
                                        <tr>
                                            <td>
                                                <div class="image">
                                                    <img src="{{ asset('storage/' . $item->image) }}" width="100" height="100" alt="">
                                                </div>
                                            </td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->subcategory->category->name }}</td>
                                            <td>
                                                <span class="status-{{ strtolower($item->status) }}">
                                                    {{ ucfirst($item->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="action-btns">
                                                    <a href="{{ route('items.show', $item->id) }}" class="eye-btn"><i class="lni lni-eye"></i></a>
                                                    <a href="{{ route('items.edit', $item->id) }}" class="edit-btn"><i class="lni lni-pencil"></i></a>
                                                    <form action="{{ route('items.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="delete-btn"><i class="lni lni-trash"></i></button>
                                                    </form>
                                                                                                    </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- Pagination Links -->
                                <div class="pagination-wrapper">
                                    {{ $paginatedItems->links() }}
                                </div>
                            </div>



					</div>
				</div>
			</div>
		</div>
	</section>
	<!--====== DASHBOARD PART END ======-->
@endsection
