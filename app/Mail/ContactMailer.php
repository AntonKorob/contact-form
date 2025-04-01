<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
class ContactMailer extends Mailable
{
    use Queueable, SerializesModels;
 
    public $data;
    public function __construct($contact)
    {
        $this->data = $contact;
    }
    public function build()
    {
        $this->from('noreply@aurora.com', 'ООО ТД Лента')
        ->subject('Форма обратной связи')
        ->view('email.feedback');
    }
}
