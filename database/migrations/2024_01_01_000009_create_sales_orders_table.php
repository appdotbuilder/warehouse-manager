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
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique()->comment('Sales order number');
            $table->date('order_date')->comment('Order date');
            $table->foreignId('customer_id')->constrained()->onDelete('restrict');
            $table->enum('status', ['pending', 'confirmed', 'shipped', 'delivered', 'cancelled'])->default('pending')->comment('Order status');
            $table->decimal('total_amount', 12, 2)->default(0)->comment('Total order amount');
            $table->text('notes')->nullable()->comment('Order notes');
            $table->timestamps();
            
            $table->index('order_number');
            $table->index('order_date');
            $table->index('customer_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_orders');
    }
};