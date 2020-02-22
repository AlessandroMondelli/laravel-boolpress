<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewLead extends Mailable
{
    use Queueable, SerializesModels;

    public $messaggio;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($new_message)
    {
        $this->messaggio = $new_message; //Variabile di istanza per portare dati nel messaggio
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@boolpress.com')->view('mail.new-message');
    }
}
