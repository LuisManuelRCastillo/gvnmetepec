<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique(); // A9328
            $table->foreignId('category_id')->constrained()->onDelete('restrict');
            $table->string('name', 200);
            $table->string('size', 50)->nullable(); // Tamaño
            $table->integer('stock')->default(0); // Qty
            $table->integer('min_stock')->default(5); // Stock mínimo para alertas
            $table->decimal('cost_price', 10, 2)->default(0); // Costo
            $table->decimal('estimated_price', 10, 2)->default(0); // Precio Estimado
            $table->decimal('sale_price', 10, 2); // Precio Final
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('code');
            $table->index('category_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}