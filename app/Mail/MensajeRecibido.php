<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MensajeRecibido extends Mailable
{
    use Queueable, SerializesModels;

    //Variables

    public $mensaje="Mensaje Recibido";

    public $msg;


    /**
     * Create a new message instance.
     * Recido la consulta de EmailCOntrolller
     * @return void
     */
    public function __construct($message)
    {
        $this->msg=$message;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('sistema.rol.admin.email.recibo')
        ->attach($this->msg['archivo']->getRealPath(),[
            'as'=>$this->msg['archivo']->getClientOriginalName(),
        ]);     
    }
}
