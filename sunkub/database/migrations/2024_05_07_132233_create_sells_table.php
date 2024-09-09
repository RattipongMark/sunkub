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
        Schema::create('sells', function (Blueprint $table) {
            $table->id('sell_id');
            $table->unsignedBigInteger('port_id'); 
            $table->unsignedBigInteger('stockp_id');
            $table->double('volume',15,4);
            $table->timestamps();

            $table->foreign('port_id')->references('port_id')->on('ports')->onDelete('cascade');
            $table->foreign('stockp_id')->references('stockp_id')->on('stock_prices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sells');
    }
};
