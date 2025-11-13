<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreatePurchasesTable extends Migration
{
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number', 50);
            $table->foreignId('supplier_id')->constrained()->onDelete('restrict');
            $table->foreignId('user_id')->constrained()->onDelete('restrict');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('tax', 10, 2)->default(0);
            $table->decimal('total', 10, 2);
            $table->enum('status', ['recibida', 'pendiente', 'cancelada'])->default('recibida');
            $table->text('notes')->nullable();
            $table->timestamp('purchase_date');
            $table->timestamps();
            
            $table->index('purchase_date');
        });
    }

    public function down()
    {
        Schema::dropIfExists('purchases');
    }
}