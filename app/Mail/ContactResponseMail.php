<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use modules\Admins\Models\Admin;
use modules\Customers\Models\Customer;

class ContactResponseMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */


//     public $name, $title, $body;
     public $admin;
     public $schools;

    public function __construct($admin, $schools)
    {
        $this->admin = $admin;
        $this->schools = $schools;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.contact-response');
    }
}
