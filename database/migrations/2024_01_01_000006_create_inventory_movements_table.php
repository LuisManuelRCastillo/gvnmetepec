<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateInventoryMovementsTable extends Migration
{
    public function up()
    {
        Schema::create('inventory_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('restrict');
            $table->foreignId('user_id')->constrained()->onDelete('restrict');
            $table->enum('type', ['entrada', 'salida', 'ajuste', 'venta', 'devolucion']);
            $table->integer('quantity'); // Positivo entrada, negativo salida
            $table->integer('stock_before');
            $table->integer('stock_after');
            $table->string('reference', 100)->nullable(); // Referencia a venta, compra, etc
            $table->text('notes')->nullable();
            $table->timestamp('movement_date');
            $table->timestamps();
            
            $table->index('product_id');
            $table->index('movement_date');
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventory_movements');
    }
}