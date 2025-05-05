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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->decimal('total_amount', 10, 2);
            $table->string('payment_method');
            $table->unsignedBigInteger('client_id')->nullable(); // Make client_id nullable
            $table->unsignedBigInteger('employee_id');
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('set null'); // Set null on client delete
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};