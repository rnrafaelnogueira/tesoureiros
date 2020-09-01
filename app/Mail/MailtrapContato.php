<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class MailtrapContato extends Mailable
{
    use Queueable, SerializesModels;

    private $nome;
    private $mensagem;
    private $telefone;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nome,$telefone,$mensagem)
    {
       $this->_nome = $nome ;
       $this->_telefone = $telefone;
       $this->_mensagem = $mensagem;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       

        return $this->view("mail.contato");
        });
        
    }
}
