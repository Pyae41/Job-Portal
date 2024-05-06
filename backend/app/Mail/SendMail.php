<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $mail;
    public function __construct($mail)
    {
        //
        $this->mail = $mail;
    }

    public function build()
    {
        return $this->subject($this->mail['subject'])->view(isset($this->mail['head']) ? 'mail.sendaremail':'mail.sendotpmail',['mail' => $this->mail]);
    }
}
