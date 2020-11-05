<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Message;

class MessageController extends Controller
{
    public function index(){
        $messages = DB::table('users')
                    ->leftjoin('client', 'users.client_id', '=', 'client.id')
                    ->leftjoin('message', 'users.id', '=', 'message.user_id')
                    ->select(
                                DB::raw('client.id "client_id"'),
                                DB::raw('client.name "client"'),
                                DB::raw('MONTH(message.created_at) "month"'),
                                DB::raw('COUNT(message.user_id) "messages"')
                            )
                    ->groupBy('client.id')
                    ->groupBy(DB::raw('MONTH(message.created_at)'))
                    ->orderBy(DB::raw('MONTH(message.created_at)'), 'DESC')
                    ->get();
        return view('welcome', compact('messages'));
    }

    public function title(){
        $messages = DB::table('message')
                    // ->leftjoin("books", "SUBSTR(JSON_EXTRACT(JSON_EXTRACT(message.meta, '$.attachment'), '$.contextual_link'),45,3)", "=", "books.book_id")
                    // ->leftjoin('books', 'SUBSTR(JSON_EXTRACT(JSON_EXTRACT(message.meta, "$.attachment"), "$.contextual_link"),45,3)', '=', 'books.book_id')
                    // ->leftjoin(DB::raw("books ON SUBSTR(JSON_EXTRACT(JSON_EXTRACT(message.meta, '$.attachment'), '$.contextual_link'),45,3) = books.book_id"))

                    // ->join('books', function ($join) {
                    //     $join->on("SUBSTR(JSON_EXTRACT(JSON_EXTRACT(message.meta, '$.attachment'), '$.contextual_link'),45,3)", "=", "books.book_id");
                    // })
                    ->select(
                                DB::raw('books.id "title"'),
                                DB::raw('CONCAT("Alpha") "environment"'),
                                DB::raw('COUNT(message.user_id) "messages"')
                            )
                    ->whereIn("SUBSTR(JSON_EXTRACT(JSON_EXTRACT(message.meta, '$.attachment'), '$.contextual_link'),45,3)", function($query)
                    {
                        $query->select('books.book_id')
                                ->from('books');
                    })
                    ->whereNotNull('books.title')
                    ->whereNotNull(DB::raw("JSON_EXTRACT(JSON_EXTRACT(message.meta, '$.attachment'), '$.contextual_name')"))
                    ->groupBy('books.title')
                    ->orderBy(DB::raw('COUNT(message.user_id)'), 'DESC')
                    ->get();
                    dd($messages);
                    
        return view('welcome', compact('messages'));
    }

    public function rooms(){
        $messages = DB::table('users')
                    ->leftjoin('client', 'users.client_id', '=', 'client.id')
                    ->leftjoin('message', 'users.id', '=', 'message.user_id')
                    ->select(
                                DB::raw('client.id "client_id"'),
                                DB::raw('client.name "client"'),
                                DB::raw('MONTH(message.created_at) "month"'),
                                DB::raw('message.room_name "room"'),
                                DB::raw('COUNT(message.user_id) "messages"')
                            )
                    ->groupBy('client.id')
                    ->groupBy(DB::raw('MONTH(message.created_at)'))
                    ->groupBy('message.room_name')
                    ->orderBy(DB::raw('MONTH(message.created_at)'), 'DESC')
                    ->get();
        return view('rooms', compact('messages'));
    }
    public function users(){
        $messages = DB::table('message')
                    ->leftjoin('users', 'users.id', '=', 'message.user_id')
                    ->leftjoin('client', 'users.client_id', '=', 'client.id')
                    ->select(
                                DB::raw('message.user_id "user_id"'),
                                DB::raw('client.name "client"'),
                                DB::raw('MONTH(message.created_at) "month"'),
                                DB::raw('CONCAT(users.firstname, " ", users.lastname)  "username"'),
                                DB::raw('COUNT(message.user_id) "messages"')
                            )
                    ->groupBy('client.id')
                    ->groupBy(DB::raw('MONTH(message.created_at)'))
                    ->groupBy('message.user_id')
                    ->groupBy('users.firstname')
                    ->groupBy('users.lastname')
                    ->orderBy(DB::raw('COUNT(message.user_id)'), 'DESC')
                    ->get();
        return view('users', compact('messages'));
    }
    public function messageType(){
        $messages = DB::table('message')
                    ->select(
                                DB::raw('message.type "message_type"'),
                                DB::raw('COUNT(message.user_id) "message"')
                            )
                    ->groupBy('message.type')
                    ->get();
        return view('messageType', compact('messages'));
    }
}
