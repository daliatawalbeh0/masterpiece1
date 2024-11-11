@extends('layouts.app')

@section('content')
<section class="banner-area bg_cover">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="banner-content">
                    <h1 class="text-white">Chat with {{ $otherUser->name }}</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="chat-container">
    <div class="chat-box">
 @if(isset($otherUser) && $otherUser->id)
    <div class="chat-header">
        <h3>{{ $otherUser->name }}</h3>
        <form action="{{ route('deal.confirm', ['user_id' => $otherUser->id]) }}" method="POST" class="deal-form">
            @csrf
            <input type="hidden" name="item_id" value="{{ $userItem->id ?? '' }}">
            <input type="hidden" name="offered_item_id" value="{{ $otherUserItem->id ?? '' }}">
            <button type="submit" class="btn btn-primary">Confirm Deal</button>
        </form>
    </div>
@else
    <p>There is no user to chat with.</p>
@endif


        <div class="messages" id="chat-messages">
            @include('partials.chat-messages', ['messages' => $messages])
        </div>

        <form action="{{ route('messages.send', $otherUser->id) }}" method="POST" class="chat-form" enctype="multipart/form-data">
            @csrf
            <textarea name="content" placeholder="Type your message here..." class="form-control"></textarea>
            <input type="file" name="image" accept="image/*" class="image-upload">
            <button type="submit" class="btn btn-primary">Send</button>
        </form>
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var messagesDiv = $('#chat-messages');
        messagesDiv.scrollTop(messagesDiv[0].scrollHeight);

        // Scroll to the bottom on new message
        function scrollToBottom() {
            messagesDiv.animate({ scrollTop: messagesDiv[0].scrollHeight }, 'slow');
        }

        // Refresh chat every 10 seconds (optional)
        setInterval(function() {
            $('#chat-messages').load(location.href + ' #chat-messages > *', function() {
                scrollToBottom();
            });
        }, 10000);
    });
</script>

<style>
    .chat-container {
        display: flex;
        justify-content: center;
        padding: 20px;
        background-color: #f5f5f5;
    }

    .chat-box {
        width: 100%;
        max-width: 800px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        padding: 20px;
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }

    .chat-header {
        margin-bottom: 20px;
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .chat-header h3 {
        font-size: 24px;
        color: #333;
        font-weight: 700;
        margin: 0;
    }

    .messages {
        max-height: 400px;
        overflow-y: auto;
        padding: 10px;
        border-bottom: 1px solid #ddd;
        margin-bottom: 20px;
        display: flex;
        flex-direction: column;
    }

    .message {
        margin-bottom: 10px;
        padding: 8px 12px;
        border-radius: 20px;
        display: inline-block;
        max-width: 80%;
        word-wrap: break-word;
        font-size: 0.9rem;
        color: #fff; /* Ensures text color is white for both sent and received */
        animation: fadeIn 0.3s ease-in-out;
    }

    .sent {
        background-color: #333f57;
        align-self: flex-end;
        text-align: right;
    }

    .received {
        background-color: #333f57;
        align-self: flex-start;
    }

    .chat-form {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .chat-form textarea {
        width: 65%;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #ddd;
        resize: none;
    }

    .image-upload {
        width: 20%;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #ddd;
        background-color: #f1f1f1;
        color: #333;
        cursor: pointer;
    }

    .chat-form button {
        width: 15%;
        padding: 10px;
        border-radius: 8px;
        background-color: #333f57;
        border: none;
        color: #fff;
        font-weight: 700;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .chat-form button:hover {
        background-color: #2b354c;
    }

    .deal-form button {
        padding: 10px 20px;
        font-size: 16px;
        font-weight: 700;
        background-color: #333f57;
        color: #fff;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .deal-form button:hover {
        background-color: #2b354c;
    }
</style>
