<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comprobante de Compra - {{ $sale->invoice_number }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f6f8fa;
            color: #F2F4F6;
            padding: 20px;
        }
        .container {
            background: #186820;
            border-radius: 8px;
            padding: 25px;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #e5e5e5;
            padding-bottom: 10px;
        }
        .header img {
            max-width: 120px;
            margin-bottom: 10px;
        }
        .header h2 {
            margin: 5px 0;
            color: #333;
        }
        .message {
            margin-top: 20px;
            line-height: 1.6;
            font-size: 15px;
        }
        .summary {
            background: #fafafa;
            color:#186820;
            padding: 15px;
            border-radius: 6px;
            margin-top: 15px;
        }
        .summary p {
            margin: 6px 0;
        }
        .footer {
            text-align: center;
            margin-top: 25px;
            font-size: 12px;
            color: #F2F4F6;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        {{-- Si tienes un logo --}}
        <img src="/assets/img/granvn-logosf.png" alt="Gran Villa Navideña Metepec">
        <h2 style="color: #f2f4f5">Gran Villa Navideña Metepec</h2>
    </div>

    <div class="message">
        <p>¡Hola {{ $sale->customer_name ?? 'Cliente' }}!</p>
        <p>
            Gracias por tu compra🎉  
            Aquí tienes tu comprobante de compra <strong>#{{ $sale->invoice_number }}</strong>.  
            En este correo encontrarás un resumen de tu pedido y un archivo PDF adjunto con todos los detalles.
        </p>
    </div>

    <div class="summary">
        <p><strong>Folio:</strong> {{ $sale->invoice_number }}</p>
        <p><strong>Fecha:</strong> {{ $sale->sale_date->format('d/m/Y H:i') }}</p>
        <p><strong>Método de pago:</strong> {{ ucfirst($sale->payment_method) }}</p>
        <p><strong>Total:</strong> ${{ number_format($sale->total, 2) }}</p>
    </div>

    <div class="message">
        <p>
            Si tienes alguna pregunta o necesitas asistencia con tu pedido, no dudes en contactarnos.  
            ¡Esperamos que disfrutes tu experiencia con nosotros!
        </p>
    </div>

    <div class="footer">
        <p>© {{ date('Y') }} Gran Villa Navideña Metepec</p>
        <p>Este es un correo automático, por favor no respondas a este mensaje.</p>
        
            <a style="color:F2F4F6" href="https://luradev.com">LuraDev - Todos los derechos reservados -2025 </a>
        
    </div>
</div>
</body>
</html>
