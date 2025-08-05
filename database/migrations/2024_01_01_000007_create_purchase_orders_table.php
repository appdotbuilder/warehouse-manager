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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique()->comment('Purchase order number');
            $table->date('order_date')->comment('Order date');
            $table->foreignId('supplier_id')->constrained()->onDelete('restrict');
            $table->enum('status', ['pending', 'confirmed', 'received', 'cancelled'])->default('pending')->comment('Order status');
            $table->decimal('total_amount', 12, 2)->default(0)->comment('Total order amount');
            $table->text('notes')->nullable()->comment('Order notes');
            $table->timestamps();
            
            $table->index('order_number');
            $table->index('order_date');
            $table->index('supplier_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};