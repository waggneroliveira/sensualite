<?php

namespace App\Mail;

use App\Models\Companion;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Support\Facades\Request;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCode extends Mailable
{
    use Queueable, SerializesModels;

    public string $password;
    public Companion $companion;

    public function __construct(Companion $companion, string $password)
    {
        $this->companion = $companion;
        $this->password = $password;
    }

    public function build()
    {

        return $this->from('anderson@hoom.com.br', 'Hoom Interativa')
            ->to($this->companion->email, $this->companion->name)
            ->subject('Seus dados de acesso ao sistema: ')
            ->view('emails.SendCode');
    }

}
