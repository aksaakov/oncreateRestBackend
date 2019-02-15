<?php

namespace App\Mail;

use App\Settings;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailHandler extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $order;

    public function __construct($data, $order)
    {
        $this->data = $data;
        $this->order = $order;
    }

    public function build()
    {
        //$address = 'info@petersalaam.com';
        $address = Settings::getSettings()->notification_email;
        $name = Settings::getSettings()->mail_from_new_order_subject;

//        $name = 'Restaurant Name';
        $subject = $this->data['subject'];


        return $this->view('emails.send')
//            ->from($address, $name)
//            ->cc($address, $name)
//            ->bcc($address, $name)
//            ->replyTo($address, $name)
            ->from($address, $name)
            ->subject($subject);
    }


}
