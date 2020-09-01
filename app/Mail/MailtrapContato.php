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
        $nome =  $this->_nome; 
        $telefone =  $this->_telefone;
        $mensagem =  $this->_mensagem;

        return $this->view("mail.contato")->send('mail.contato', ["nome" => $nome, 'telefone' =>  $telefone, 'mensagem' => $mensagem], function ($mail) use ($nome, $telefone, $mensagem){
            $mail->from('rnrafaelnogueira@gmail.com', 'Cliente entranto em contato - LAB NECY VIEIRA');
            $mail->to('rnrafaelnogueira@gmail.com' , 'Web Site')->subject('Cliente entranto em contato - LAB NECY VIEIRA');
            $mail->bcc("necyvnogueira@gmail.br");
        });
        
    }
}
