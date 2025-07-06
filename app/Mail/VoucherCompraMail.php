<?php

namespace App\Mail;

use App\Models\Compra;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class VoucherCompraMail extends Mailable
{
    use Queueable, SerializesModels;

    public $compra;

    /**
     * Create a new message instance.
     */
    public function __construct(Compra $compra)
    {
        $this->compra = $compra;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Voucher de Compra - TicketGO (PDF Adjunto)',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.voucher-compra',
            with: [
                'compra' => $this->compra,
                'usuario' => $this->compra->usuario,
                'evento' => $this->compra->evento,
                'detalles' => $this->compra->detalles,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        try {
            // Generar el PDF del voucher
            $pdf = Pdf::loadView('emails.voucher-compra-pdf', [
                'compra' => $this->compra,
                'usuario' => $this->compra->usuario,
                'evento' => $this->compra->evento,
                'detalles' => $this->compra->detalles,
            ]);

            // Configurar el PDF para mejor calidad
            $pdf->setPaper('a4', 'portrait');
            $pdf->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'defaultFont' => 'Arial'
            ]);

            // Generar el contenido del PDF
            $pdfContent = $pdf->output();

            return [
                Attachment::fromData(
                    fn () => $pdfContent,
                    'Voucher_Compra_TG-' . $this->compra->id . '.pdf'
                )
                ->withMime('application/pdf')
            ];
        } catch (\Exception $e) {
            // Si hay error generando el PDF, no adjuntar nada
            \Log::error('Error generando PDF para voucher: ' . $e->getMessage());
            return [];
        }
    }
} 