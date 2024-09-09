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
        Schema::create('view_admins', function (Blueprint $table) {
            $table->unsignedBigInteger('broker_id');
            $table->unsignedBigInteger('admin_id');

            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('broker_id')->references('broker_id')->on('brokers')->onDelete('cascade');

            $table->primary(['broker_id', 'admin_id']);
        });

        Schema::create('view_stocks', function (Blueprint $table) {
            $table->unsignedBigInteger('broker_id');
            $table->string('stock_symbol',10);

            $table->foreign('stock_symbol')->references('stock_symbol')->on('stocks')->onDelete('cascade');
            $table->foreign('broker_id')->references('broker_id')->on('brokers')->onDelete('cascade');

            $table->primary(['broker_id', 'stock_symbol']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('view_admins');
        Schema::dropIfExists('view_stocks');
    }
};
