<header class="header_area">
    <div id="header_navbar" class="header_navbar">
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-xl-12">
                    <nav class="navbar navbar-expand-lg">
                        <!-- Logo -->
                        <a class="navbar-brand" href="{{ route('home') }}">
                            <img id="logo" src="assets/images/logo/logo.svg" alt="Logo">
                        </a>

                        <!-- Navbar Toggler -->
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>

                        <!-- Navbar Links -->
                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                            <ul id="nav" class="navbar-nav mr-auto">
                                <li class="nav-item">
                                    <a class="page-scroll active" href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="page-scroll" href="{{ route('category') }}">Category</a>
                                </li>
                            </ul>

                            <!-- Notification & Action Buttons -->
                            <ul class="header-btn d-md-flex align-items-center">
                                <!-- Messages Notification Dropdown -->
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-envelope"></i>
                                        @if(Auth::check() && $notifications->where('type', 'App\Notifications\UserMessageNotification')->count())
                                            <span class="badge badge-danger">{{ $notifications->where('type', 'App\Notifications\UserMessageNotification')->count() }}</span>
                                        @endif
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="messageDropdown">
                                        @if(Auth::check() && $notifications->where('type', 'App\Notifications\UserMessageNotification')->count())
                                            @foreach($notifications->where('type', 'App\Notifications\UserMessageNotification') as $notification)
                                                <a class="dropdown-item" href="#">
                                                    <i class="fas fa-envelope-open-text"></i> {{ $notification->data['message'] ?? 'You have a new message' }}
                                                </a>
                                            @endforeach
                                            <a href="{{ route('notifications.markAsRead') }}" class="dropdown-item">Mark all as read</a>
                                        @else
                                            <a class="dropdown-item" href="#">No new messages</a>
                                        @endif
                                    </div>
                                </li>

                                <!-- General Notification Dropdown -->
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-bell"></i>
                                        @if(Auth::check() && $notifications->where('type', 'App\Notifications\AdStatusNotification')->count())
                                            <span class="badge badge-danger">{{ $notifications->where('type', 'App\Notifications\AdStatusNotification')->count() }}</span>
                                        @endif
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="notificationDropdown">
                                        @if(Auth::check() && $notifications->where('type', 'App\Notifications\AdStatusNotification')->count())
                                            @foreach($notifications->where('type', 'App\Notifications\AdStatusNotification') as $notification)
                                                <a class="dropdown-item" href="#">
                                                    <i class="fas fa-bell"></i> {{ $notification->data['message'] ?? 'You have a new notification' }}
                                                </a>
                                            @endforeach
                                            <a href="{{ route('notifications.markAsRead') }}" class="dropdown-item">Mark all as read</a>
                                        @else
                                            <a class="dropdown-item" href="#">No new notifications</a>
                                        @endif
                                    </div>
                                </li>

                                <!-- My Account Button -->
                                <li class="nav-item">
                                    <a href="{{ route('userdashboard') }}" class="main-btn account-btn no-border">
                                        <i class="fas fa-user"></i>
                                    </a>
                                </li>

                                <!-- Post An Ad Button -->
                                <li class="tooltip-btn">
                                    <a href="{{ route('postad') }}" class="main-btn btn-hover post-ad-btn">
                                        <i class="fas fa-exchange-alt"></i>
                                        <span class="btn-text">List Item for Exchange</span>
                                    </a>
                                </li>

                                <!-- Donate Now Button -->
                                <li class="tooltip-btn">
                                    <a href="{{ route('create_donation') }}" class="main-btn btn-hover donate-btn">
                                        <i class="fas fa-hand-holding-heart"></i>
                                        <span class="btn-text">Donate Now</span>
                                    </a>
                                </li>
                            </ul>
                        </div> <!-- navbar-collapse -->
                    </nav> <!-- navbar -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- header navbar -->
</header>

<!-- CSS for Styling and Hover Effects -->
<style>
    .account-btn {
        border: none;
        background: none;
        padding: 0;
        color: #333;
        font-size: 1.2rem;
    }
    .tooltip-btn .btn-text {
        display: none;
        margin-left: 5px;
        font-weight: bold;
    }
    .tooltip-btn:hover .btn-text {
        display: inline;
    }
    .post-ad-btn, .donate-btn {
        padding: 8px 12px;
        border-radius: 5px;
        margin: 0 5px;
        color: #fff;
        display: flex;
        align-items: center;
    }
    .post-ad-btn {
        background-color: #ff5a5f;
    }
    .donate-btn {
        background-color: #007bff;
    }
    .post-ad-btn:hover, .donate-btn:hover {
        opacity: 0.85;
    }
    .badge-danger {
        position: absolute;
        top: -5px;
        right: -5px;
        font-size: 0.8rem;
        padding: 3px 6px;
        border-radius: 50%;
    }
</style>
