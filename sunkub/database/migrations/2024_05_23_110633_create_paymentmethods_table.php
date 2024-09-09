<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentmethodsTable extends Migration
{
    public function up(): void
    {
        Schema::create('paymentmethods', function (Blueprint $table) {
            $table->string('card_number')->primary(); // Primary key
            $table->unsignedBigInteger('user_id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->integer('expiry_month')->nullable();
            $table->integer('expiry_year')->nullable();
            $table->string('cvv')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paymentmethods');
    }
}