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
        Schema::create('sectors', function (Blueprint $table) {
            $table->id('sector_id');
            $table->string('sector_name');
        });

        Schema::create('stocks', function (Blueprint $table) {
            $table->string('stock_symbol',10);
            $table->unsignedBigInteger('sector_id'); 
            $table->string('stock_name');
            $table->double('stock_current_price');
            $table->timestamps();

            $table->foreign('sector_id')->references('sector_id')->on('sectors')->onDelete('cascade');

            $table->primary(['stock_symbol']);
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
