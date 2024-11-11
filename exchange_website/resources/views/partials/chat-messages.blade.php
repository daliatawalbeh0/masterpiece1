@foreach($messages as $message)
    <div class="message {{ $message->sender_id == Auth::id() ? 'sent' : 'received' }}">
        <p>{{ $message->content }}</p>
        <small>{{ $message->created_at->diffForHumans() }}</small>
    </div>
@endforeach
