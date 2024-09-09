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
            $table->string('stock_symbol',10);

            $table->foreign('stock_symbol')->references('stock_symbol')->on('stocks')->onDelete('cascade');
            $table->foreign('port_id')->references('port_id')->on('ports')->onDelete('cascade');

            $table->primary(['port_id', 'stock_symbol']);
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
