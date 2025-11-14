<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Sale;

class SaleReceipt extends Mailable
{
    use Queueable, SerializesModels;

    public $sale;
    public $pdfData;

    public function __construct(Sale $sale, $pdfData)
    {
        $this->sale = $sale;
        $this->pdfData = $pdfData;
    }

    public function build()
    {
        return $this->subject("Comprobante de Compra - {$this->sale->invoice_number}")
                    ->view('emails.sale-receipt') // vista para el contenido del correo
                    ->attachData($this->pdfData, "Comprobante_{$this->sale->invoice_number}.pdf", [
                        'mime' => 'application/pdf',
                    ]);
    }
}
