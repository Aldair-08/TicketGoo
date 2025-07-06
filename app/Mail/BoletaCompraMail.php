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

class BoletaCompraMail extends Mailable
{
    use Queueable, SerializesModels;

    public $compra;
    public $datosPago;

    /**
     * Create a new message instance.
     */
    public function __construct(Compra $compra, $datosPago = null)
    {
        $this->compra = $compra;
        
        // Decodificar datos de pago si están en formato JSON
        if (is_string($datosPago) && !empty($datosPago)) {
            $this->datosPago = json_decode($datosPago, true) ?: $datosPago;
        } else {
            $this->datosPago = $datosPago;
        }
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Boleta de Compra - TicketGO',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.boleta-compra',
            with: [
                'compra' => $this->compra,
                'usuario' => $this->compra->usuario,
                'evento' => $this->compra->evento,
                'detalles' => $this->compra->detalles,
                'datosPago' => $this->datosPago,
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
            // Preparar datos para la boleta
            $datosBoleta = [
                'nombre_cuenta' => $this->compra->usuario->name,
                'dni' => $this->compra->usuario->dni,
                'correo' => $this->compra->usuario->email,
                'evento' => $this->compra->evento->nombre ?? 'Evento no disponible',
                'fecha' => $this->compra->evento->fecha_evento_formateada ?? 'Por definir',
                'ubicacion' => $this->compra->evento->ubicacion ?? 'Por definir',
                'fecha_pago' => $this->compra->fecha_pago ? $this->compra->fecha_pago->format('d/m/Y H:i') : now()->format('d/m/Y H:i'),
                'entradas' => $this->compra->detalles->map(function ($detalle) {
                    return [
                        'cantidad' => $detalle->cantidad,
                        'tipo' => strtoupper($detalle->tipo_ticket),
                        'subtotal' => $detalle->cantidad * $detalle->precio_unitario,
                    ];
                })->toArray(),
                'total' => $this->compra->total,
                'metodo_pago' => $this->datosPago['metodo'] ?? 'No especificado',
                'datos_pago' => $this->datosPago['detalles'] ?? null,
            ];

            // Generar el PDF de la boleta
            $pdf = Pdf::loadView('usuario.boleta_pdf', $datosBoleta);

            // Configurar el PDF
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
                    'Boleta_Compra_TG-' . $this->compra->id . '.pdf'
                )
                ->withMime('application/pdf')
            ];
        } catch (\Exception $e) {
            // Si hay error generando el PDF, no adjuntar nada
            \Log::error('Error generando boleta PDF: ' . $e->getMessage());
            return [];
        }
    }
} 