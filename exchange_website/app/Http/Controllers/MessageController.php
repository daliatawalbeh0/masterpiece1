<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\TheUser;
use App\Models\Exchange;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\UserMessageNotification;
use Carbon\Carbon;

class MessageController extends Controller
{
    public function showConversation($userId)
    {
        $messages = Message::where(function ($query) use ($userId) {
            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $userId);
        })
            ->orWhere(function ($query) use ($userId) {
                $query->where('sender_id', $userId)
                    ->where('receiver_id', Auth::id());
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return view('messages.conversation', compact('messages', 'userId'));
    }



    public function sendMessage(Request $request, $user_id)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $user_id,
            'content' => $request->input('content'),
        ]);

        $recipientUser = TheUser::find($user_id);

        $notificationMessage = "You have a new message from " . Auth::user()->name;
        $recipientUser->notify(new UserMessageNotification($notificationMessage));

        return redirect()->route('chat', ['user_id' => $user_id]);
    }

    public function confirmDeal(Request $request, $user_id)
    {
        $sender_id = Auth::id();
        $receiver_id = $user_id;
        $item_id = $request->input('item_id'); // Get item_id from the form
        $offered_item_id = $request->input('offered_item_id'); // Get offered_item_id from the form

        $existingDeal = Exchange::where(function ($query) use ($sender_id, $receiver_id) {
            $query->where('sender_id', $sender_id)
                ->where('receiver_id', $receiver_id);
        })->orWhere(function ($query) use ($sender_id, $receiver_id) {
            $query->where('sender_id', $receiver_id)
                ->where('receiver_id', $sender_id);
        })->first();

        if ($existingDeal) {
            return redirect()->back()->with('error', 'Deal already confirmed.');
        }

        Exchange::create([
            'sender_id' => $sender_id,
            'receiver_id' => $receiver_id,
            'item_id' => $item_id, // Add item_id here
            'offered_item_id' => $offered_item_id, // Add offered_item_id here
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect to a route or view after deal creation
        return redirect()->route('home')->with('success', 'Deal initiated. Awaiting admin approval.');
    }



    public function showChat($otherUserId)
    {
        $otherUser = TheUser::findOrFail($otherUserId);

        $userItem = Item::where('user_id', Auth::id())->first();

        $otherUserItem = Item::where('user_id', $otherUserId)->first();

        $messages = Message::where(function ($query) use ($otherUserId) {
            $query->where('sender_id', Auth::id())->where('receiver_id', $otherUserId);
        })->orWhere(function ($query) use ($otherUserId) {
            $query->where('sender_id', $otherUserId)->where('receiver_id', Auth::id());
        })
            ->orderBy('created_at', 'asc') // ترتيب الرسائل تصاعدياً بناءً على وقت الإنشاء
            ->get();

        return view('chat', compact('otherUser', 'userItem', 'otherUserItem', 'messages'));
    }


    public function index()
    {
        $userId = Auth::id();

        $conversations = Message::where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->get()
            ->unique(function ($conversation) use ($userId) {
                return $conversation->sender_id == $userId ? $conversation->receiver_id : $conversation->sender_id;
            });

        $unreadCounts = [];

        foreach ($conversations as $conversation) {
            $otherUserId = $conversation->sender_id == $userId ? $conversation->receiver_id : $conversation->sender_id;

            $unreadCounts[$otherUserId] = Message::where('sender_id', $otherUserId)
                ->where('receiver_id', $userId)
                ->where('is_read', 0)
                ->count();
        }

        return view('messages.index', compact('conversations', 'unreadCounts'));
    }


    // public function show($id)
    // {
    //     $messages = Message::where('id', $id)->get();
    //     return view('messages.show', compact('messages'));
    // }
    public function show($otherUserId)
    {
        $userId = Auth::id();

        // تحديث جميع الرسائل غير المقروءة من المستخدم الآخر إلى "مقروءة"
        Message::where('sender_id', $otherUserId)
            ->where('receiver_id', $userId)
            ->where('is_read', 0)
            ->update(['is_read' => 1]);

        // جلب جميع الرسائل بين المستخدمين
        $messages = Message::where(function ($query) use ($userId, $otherUserId) {
            $query->where('sender_id', $userId)
                ->where('receiver_id', $otherUserId);
        })
            ->orWhere(function ($query) use ($userId, $otherUserId) {
                $query->where('sender_id', $otherUserId)
                    ->where('receiver_id', $userId);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        $otherUser = TheUser::findOrFail($otherUserId);

        return view('chat.show', compact('messages', 'otherUser'));
    }
}
