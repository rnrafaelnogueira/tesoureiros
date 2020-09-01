<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Contate extends Mailable
{
    use Queueable, SerializesModels;

    public $nome;
    public $mensagem;
    public $telefone;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nome,$telefone,$mensagem )
    {
        $this->nome = $nome ;
        $this->telefone = $telefone;
        $this->mensagem = $mensagem;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.contato');
    }
}
