<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositDetailsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('deposit_details', function (Blueprint $table) {
            $table->id('deposit_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('port_id');
            $table->double('payment_amount', 15, 4);
            $table->timestamp('timestamp')->useCurrent();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposit_details');
    }
}
