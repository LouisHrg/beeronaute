<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Message;
use App\Event;
use App\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laracasts\Utilities\JavaScript\JavaScriptFacade;
use Laracasts\Utilities\JavaScript\JavaScriptServiceProvider;

class ChatsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show chats
     *
     * @return \Illuminate\Http\Response
     */
    public function index($eventId)
    {

        $participate = Subscription::where('user_id', "=", Auth::id())
            ->where('event', "=", $eventId)
            ->get()->isNotEmpty();
        if($participate){  
            $event = Event::find($eventId)->first();
            return view('chat.chat',compact('event'));
        }


        abort(404);

    }

    /**
     * Fetch all messages
     *
     * @return Message
     */
    public function fetchMessages($eventid)
    {
        return Message::with('user')->where('event_id', '=', $eventid)->get();
    }

    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return Response
     */
    public function sendMessage(Request $request)
    {
        $user = Auth::user();
        var_dump($request->input());
        $message = new Message();
        $message->user_id = $user->id;
        $message->message = $request->input('message');
        $message->event_id = $request->input('eventid');
        $message->save();
        broadcast(new MessageSent($user, $message))->toOthers();

        return ['status' => 'Message Sent!'];
    }


}
