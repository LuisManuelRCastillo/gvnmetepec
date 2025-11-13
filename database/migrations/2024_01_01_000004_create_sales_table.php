<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateSalesTable extends Migration
{
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number', 50)->unique(); // Folio
            $table->foreignId('user_id')->constrained()->onDelete('restrict'); // Vendedor
            $table->foreignId('customer_id')->nullable()->constrained()->onDelete('set null');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('tax', 10, 2)->default(0); // IVA 16%
            $table->decimal('total', 10, 2);
            $table->enum('payment_method', ['efectivo', 'tarjeta', 'transferencia', 'mixto'])->default('efectivo');
            $table->decimal('amount_paid', 10, 2);
            $table->decimal('change_amount', 10, 2)->default(0);
            $table->enum('status', ['completada', 'cancelada', 'pendiente'])->default('completada');
            $table->text('notes')->nullable();
            $table->timestamp('sale_date');
            $table->boolean('email_sent')->default(false); // Control de envío
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('invoice_number');
            $table->index('sale_date');
            $table->index('user_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
