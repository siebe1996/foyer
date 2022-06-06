<?php

namespace App\Http\Controllers;

use App\Events\ChatMessage;
use App\Http\Resources\MessageCollection;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MessageApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::id();

        $messages = new MessageCollection(Message::where('receiver_id', $userId)->get());

        return response(['data' => $messages], 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */

    public function store(Request $request)
    {
        $request->validate([
            'content'=>'required',
            'user'=>'required|numeric',
        ]);

        $senderId = Auth::id();
        $sender = User::findOrFail($senderId);
        $receiver = User::findOrFail($request->user);
        $message = new Message();
        $message->content = $request->input('content');
        $message->sender_id = $senderId;
        $message->receiver_id = $request->input('user');
        //$message->user()->associate($sender);
        //$message->user()->associate($receiver);
        $message->save();

        //broadcast(new ChatMessage($message));

        //return "true";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!is_numeric($id)){
            return response(['data' => 'bad request'], 400)
                ->header('Content-Type', 'application/json');
        }

        $message = Message::findOrFail($id);
        $this->authorize('forceDelete', $message);
        $message->delete();

        return response(['data' => 'resource deleted successfully'], 200)
            ->header('Content-Type', 'application/json');
    }
}
