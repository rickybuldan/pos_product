<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    
    public function up(): void
    {
        Schema::create('stock_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_product');
            $table->bigInteger('stock');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */

    public function down(): void
    {
        Schema::dropIfExists('stock_products');
    }

};
