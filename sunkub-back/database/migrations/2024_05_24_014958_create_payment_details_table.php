<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payment_details', function (Blueprint $table) {
            $table->id('pay_id'); // Primary key
            $table->unsignedBigInteger('deposit_id'); // Foreign key referencing 'deposit_details' table
            $table->unsignedBigInteger('port_id'); // Foreign key referencing 'ports' table
            $table->double('amount', 15, 4); // Amount

            // Foreign key constraints
            $table->foreign('deposit_id')->references('deposit_id')->on('deposit_details')->onDelete('cascade');
            $table->foreign('port_id')->references('port_id')->on('ports')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_details');
    }
}