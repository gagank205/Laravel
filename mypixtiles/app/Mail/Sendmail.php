<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Sendmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data_action;
    public function __construct($data)
    {
        $this->data_action=$data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url=$this->data_action;
        return $this->view('mail.forgotpassword',compact('url'));
    }
}
