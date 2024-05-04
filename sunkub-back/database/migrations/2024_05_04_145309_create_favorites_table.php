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
        Schema::create('favorites', function (Blueprint $table) {
            $table->unsignedBigInteger('port_id');
            $table->unsignedBigInteger('stock_id');

            $table->foreign('stock_id')->references('stock_id')->on('stocks')->onDelete('cascade');
            $table->foreign('port_id')->references('port_id')->on('ports')->onDelete('cascade');

            $table->primary(['ports_id', 'stock_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};
