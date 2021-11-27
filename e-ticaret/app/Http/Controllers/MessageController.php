<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function editmessage(Request $request)
    {
        return Message::where('id', $request->id)->first();
    }
    public function editedmessage(Request $request)
    {
        $message = Message::where('id', $request->id)->first();
        $message->note = $request->note;
        $message->is_okey = $request->is_okey;
        $message->save();
        return Message::all();
    }
    public function deletemessage(Request $request)
    {
        Message::where('id', $request->id)->first()->delete();
        return Message::all();
    }
    public function allmessages()
    {
        return Message::all();
    }
    public function sendmessage(Request $request)
    {
        $request->validate([
            'name' => ['required '],
            'topic' => ['required', 'min:8'],
            'message' => ['required', 'min:16'],
            'email' => ['email'],
        ]);
        $message = new Message();
        $message->name = $request->name;
        $message->email = $request->email;
        $message->phone = $request->phone;
        $message->topic = $request->topic;
        $message->message = $request->message;
        $message->save();
    }
}
