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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            // $table->unsignedBigInteger('menu_access_id');
            
            $table->unsignedBigInteger('user_id'); 
            $table->string('no_transaction');
            $table->date('transaction_date');
            $table->string('transaction_type');

            $table->integer('status');
            $table->unsignedBigInteger('created_by');
            $table->string('price_total');

            $table->timestamps();

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade'); //

            $table->foreign('created_by')
            ->references('id')
            ->on('users')
            ->onDelete('cascade'); //

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
