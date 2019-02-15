<?php

namespace App\Http\Controllers;
use App\Mail\EmailHandler;
use Mail;

class EmailController extends Controller
{

    static public function sendOrderConfirmation($order_details){
        $data = [
            'subject' => 'New Order',
            'content' => 'Details about the order will go here! (going to spam?)'
        ];
        Mail::to('chalikov@oncreate.studio')->send(new EmailHandler($data, $order_details));

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
