<?php

namespace App\Mail;

use App\Models\Ocorrencia;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OcorrenciaRegistradaMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $ocorrencia;

    /**
     * Cria uma nova instância da mensagem passando os dados da ocorrência.
     */
    public function __construct(Ocorrencia $ocorrencia)
    {
        $this->ocorrencia = $ocorrencia;
    }

    /**
     * Define o assunto e remetente do e-mail.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Comunicado Escolar: Registro de Ocorrência - IFES Campus Alegre',
        );
    }

    /**
     * Define a view/template HTML que será renderizado no e-mail.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.ocorrencia_registrada',
        );
    }

    /**
     * Anexos (caso precise no futuro).
     */
    public function attachments(): array
    {
        return [];
    }
}