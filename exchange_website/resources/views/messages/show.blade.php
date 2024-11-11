@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Chat with {{ $otherUser->name }}</h4>
                    <form action="{{ route('deal.confirm', ['user_id' => $otherUser->id]) }}" method="POST" class="ml-auto">
                        @csrf
                        <input type="hidden" name="item_id" value="{{ $userItem->id }}">
                        <input type="hidden" name="offered_item_id" value="{{ $otherUserItem->id }}">
                        <button type="submit" class="btn btn-primary">Confirm Deal</button>
                    </form>
                </div>
                <div class="card-body">
                    <div class="messages-list">
                        @foreach($messages as $message)
                            <div class="message {{ $message->sender_id == Auth::id() ? 'sent' : 'received' }}">
                                <p>{{ $message->content }}</p>
                                <small>{{ $message->created_at->diffForHumans() }}</small>
                            </div>
                        @endforeach
                    </div>

                    <form action="{{ route('messages.send', $otherUser->id) }}" method="POST" enctype="multipart/form-data" class="d-flex align-items-center mt-3">
                        @csrf
                        <textarea name="content" class="form-control" placeholder="Type your message..."></textarea>
                        <input type="file" name="image" class="form-control-file mx-2" style="width: auto; padding: 4px;">
                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .messages-list {
        max-height: 400px;
        overflow-y: auto;
        margin-bottom: 20px;
    }

    .message {
        margin-bottom: 15px;
        padding: 10px;
        border-radius: 10px;
    }

    .sent {
        background-color: #e9f7fe;
        text-align: right;
    }

    .received {
        background-color: #f1f1f1;
        text-align: left;
    }

    /* Adjust the form controls for a more compact layout */
    .form-control-file {
        max-width: 80px;
    }

    .btn-primary {
        background-color: #333f57;
        border: none;
    }

    .btn-primary:hover {
        background-color: #2b354c;
    }
</style>
