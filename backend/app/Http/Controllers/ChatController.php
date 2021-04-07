<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageSent;
use App\Models\Message;
use Pusher\Pusher;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        return view('chat.index');
    }

    public function fetchMessages(Request $request)
    {
        return Message::with('user')->get();
    }

    public function sendMessage(Request $request)
    {
        $user = $request->user();

        $message = $user->messages()->create([
            'message' => $request->input('message')
        ]);

        MessageSent::dispatch($user, $message);

        //return ['status' => 'Message Sent!'];
    }

    public function sendtest(Request $request)
    {
        //event(new MessageSent("hoge", "fuga"));
        var_dump("hogeee");
        MessageSent::dispatch($request->user());

    }
}
