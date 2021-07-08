<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SampleMail extends Mailable
{
    use Queueable, SerializesModels;
 
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
                ->view(‘admin.mail_send’)
                ->from('be4b3ec92a-e466fe@inbox.mailtrap.io');
    }
}
