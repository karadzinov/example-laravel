<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $toUser;
    protected $mailMessage;

    public function __construct($toUser, $mailMessage)
    {
        $this->toUser = $toUser;
        $this->mailMessage = $mailMessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = ['mailMessage' => $this->mailMessage, 'user' => $this->toUser];
        return $this->view('vendor.mail.mail')->with($data);
    }
}
