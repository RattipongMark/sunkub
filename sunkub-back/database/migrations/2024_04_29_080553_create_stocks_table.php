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
            $table->id('stock_id');
            $table->unsignedBigInteger('broker_id'); 
            $table->unsignedBigInteger('sector_id'); 
            $table->string('stock_shortname',5);
            $table->string('stock_name');
            $table->double('stock_current_price');
            $table->timestamps();

            $table->foreign('broker_id')->references('broker_id')->on('brokers')->onDelete('cascade');
            $table->foreign('sector_id')->references('sector_id')->on('sectors')->onDelete('cascade');
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
