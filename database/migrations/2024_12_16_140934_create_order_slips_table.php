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
        Schema::create('order_slips', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique()->autoIncrement();
            $table->string('customer_name');
            $table->integer('table_number');
            $table->text('notes')->nullable();
            $table->enum('status', ['pending', 'preparing', 'served', 'paid', 'cancelled'])->default('pending');
            $table->decimal('total_price', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_slip');
    }
};
