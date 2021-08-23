<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailSend extends Mailable
{
    use Queueable, SerializesModels;

    public $infoCommand, $infoSession;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($infoCommand, $infoSession)
    {
        $this->infoCommand = $infoCommand;
        $this->infoSession = $infoSession;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.mail')
            ->subject('Order for ' . $this->infoCommand->name)
            ->from(\Config::get('values.from'))
            ->with('data', $this->infoCommand)
            ->with('products', $this->infoSession);
    }
}
