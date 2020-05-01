<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DenyEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $item, $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($item, $user)
    {
        $this->item = $item;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.deny')->subject('Item request')->with('data', $this->item, $this->user);
    }
}
