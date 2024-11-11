@extends('layouts.app')

@section('content')


<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>Your Conversations</h4>
                </div>
                <div class="card-body">
                    <div class="conversations-list">
                        @foreach($conversations as $conversation)
                            @php
                                $otherUser = $conversation->sender_id == Auth::id() ? $conversation->receiver : $conversation->sender;
                                $unreadCount = $unreadCounts[$otherUser->id] ?? 0;
                            @endphp
                            <a href="{{ route('chat', $otherUser->id) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <span>{{ $otherUser->name }}</span>
                                @if($unreadCount > 0)
                                    <span class="badge badge-danger">{{ $unreadCount }} new</span>
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .container {
        margin-top: 50px; /* لتعديل المسافة من الأعلى */
    }

    .card-header {
        background-color: transparent; /* لإزالة الشريط الأزرق */
        border-bottom: 2px solid #ff5a5f; /* خط سفلي للتصميم */
    }

    .card-header h4 {
        font-weight: bold;
        color: #333; /* لون النص */
    }

    .badge-danger {
        background-color: #ff5a5f; /* اللون الأحمر للشارة */
        color: white;
        padding: 5px 10px;
        border-radius: 12px;
        font-size: 0.9rem;
    }

    .list-group-item-action:hover {
        background-color: #f7f7f7; /* لون الخلفية عند التحويم */
        color: #333;
    }

    .list-group-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        margin-bottom: 10px;
    }
</style>
