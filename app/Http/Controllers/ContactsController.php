<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactsController extends Controller
{
    public function index()
    {
        $contacts = User::where('id', '!=', auth()->user()->id)->get();


        $unreadIds = Message::select(DB::raw('`from` as sender_id, count(`from`) as messages_count'))
            ->where('to', auth()->user()->id)
            ->where('read', false)
            ->groupBy('from')
            ->get();

        $contacts = $contacts->map(function ($contact) use ($unreadIds) {
            $contactUnread = $unreadIds->where('sender_id', $contact->id)->first();

            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;

            return $contact;
        });


        return response()->json($contacts);
    }

    public function getMessagesFor(Request $request, $id)
    {

        Message::where('from', $id)->where('to', auth()->user()->id)->update(['read' => true]);

        $messages = Message::where(function ($q) use ($id) {
            $q->where('from', auth()->user()->id);
            $q->where('to', $id);
        })->orWhere(function ($q) use ($id) {
            $q->where('from', $id);
            $q->where('to', auth()->user()->id);
        })
            ->get();


        return response()->json($messages);
    }

    public function sendMessage(Request $request)
    {
        $message = Message::create([
            'from' => auth()->user()->id,
            'to' => $request->contact_id,
            'message' => $request->message
        ]);

        broadcast(new NewMessage($message));

        return response()->json($message);
    }
}
