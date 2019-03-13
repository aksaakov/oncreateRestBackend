<?php

namespace App\Http\Controllers;
use App\Mail\OrderRequestMail;
use Mail;
use Illuminate\Support\Facades\Log;

class EmailController extends Controller
{

    static public function sendNewOrderReq($order){
        Mail::to('a.cealicov@gmail.com')->send(new OrderRequestMail($order));
        return response()->json(['message' => 'Request completed']);
    }

//    public function send(Request $request)
//    {
//        $title = $request->input('title');
//        $content = $request->input('content');
//
//        Mail::send('emails.send', ['title' => $title, 'content' => $content], function ($message)
//        {
//
//            $message->from('a.cealicov@gmail.com', 'Peter Nwamba');
//
//            $message->to('a.cealicov@gmail.com');
//
//        });
//
//
//        return response()->json(['message' => 'Request completed']);
//    }
}
