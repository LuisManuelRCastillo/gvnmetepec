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
    
    public function __construct(Sale $sale)
    {
        $this->sale = $sale;
    }
    
    public function build()
    {
        return $this->subject('Comprobante de Compra - ' . $this->sale->invoice_number)
                    ->view('emails.sale-receipt');
    }
}
