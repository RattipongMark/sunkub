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
        Schema::create('stock_prices', function (Blueprint $table) {
            $table->id('stockp_id');
            $table->string('stock_symbol',10);
            $table->double('stockp_close',15,4);
            $table->timestamps();

            $table->foreign('stock_symbol')->references('stock_symbol')->on('stocks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_prices');
    }
};
