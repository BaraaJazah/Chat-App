<?php

namespace App\Http\Controllers;

use App\Events\PrivateMessageSent;
use App\Events\userTyping;
use App\Models\chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ChatController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        $receiver = User::find($users[0]->id);

        $receiverId = $users[0]->id;

        $chats = chat::where(function ($query) use ($receiverId) {
            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $receiverId);
        })->orWhere(function ($query) use ($receiverId) {
            $query->where('sender_id', $receiverId)
                ->where('receiver_id', Auth::id());
        })->get();

        return view('chat.index', compact('users', 'chats', 'receiver'));
    }


    public function chat($receiverId)
    {
        $users = User::where('id', '!=', Auth::id())->get();

        $receiver = User::find($receiverId);

        $chats = chat::where(function ($query) use ($receiverId) {
            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $receiverId);
        })->orWhere(function ($query) use ($receiverId) {
            $query->where('sender_id', $receiverId)
                ->where('receiver_id', Auth::id());
        })->get();

        return view('chat.index', compact('users', 'chats', 'receiver'));
    }

    public function sendMessage(Request $request, $receiverId)
    {

        // save message
        $newMessage = chat::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $receiverId,
            'message' => $request->message,
        ]);

        // fire the message broadcast
        broadcast(new PrivateMessageSent($newMessage))->toOthers();

        return response()->json(['status' => 'message sent!']);
    }

    public function typing($receiverId)
    {
        // fire the typing broadcast
        // (me is typing )
        broadcast(new userTyping(Auth::id(), $receiverId))->toOthers();
        return response()->json(['status' => 'user Typing!']);
    }


    public function setOnline()
    {
        Cache::put('user-is-online' . Auth::id(), true, now()->addMinutes(5));
        return response()->json(['status' => 'online!']);
    }

    public function setOffline()
    {
        Cache::forget('user-is-online' . Auth::id());
        return response()->json(['status' => 'Offline!']);
    }
}
