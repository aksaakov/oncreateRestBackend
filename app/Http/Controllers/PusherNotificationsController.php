<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pusher\Pusher;

class PusherNotificationsController extends Controller
{
    public static function sendNotification()
    {
        //Remember to change this with your cluster name.
        $options = array(
            'cluster' => 'eu',
            'encrypted' => true
        );

        //Remember to set your credentials below.
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $message = "test message";

//        $message= PushNotification::Message('Message Text',array(
//            'sound' => 'storage/notification_sound.aiff', // EDIT THIS filename
//        ));

        //Send a message to notify channel with an event name of notify-event
        $pusher->trigger('notify', 'notify-event', $message);
    }
}
