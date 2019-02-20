<?php

namespace App\Mail;

use App\Settings;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class OrderRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function build()
    {
        $address = 'info@petersalaam.com';
        $name = 'New Order';
        //$address = Settings::getSettings()->notification_email;
        //$name = Settings::getSettings()->mail_from_new_order_subject;

        
        
        //$subject = $this->data['subject'];
        $subject = 'Order Id: ' . ($this->order['id']);
        
        return $this->view('emails.send')
//            ->from($address, $name)
//            ->cc($address, $name)
//            ->bcc($address, $name)
//            ->replyTo($address, $name)
            ->from($address, $name)
            ->subject($subject);
    }
}
