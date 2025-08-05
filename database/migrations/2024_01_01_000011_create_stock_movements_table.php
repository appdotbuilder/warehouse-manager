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
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('restrict');
            $table->foreignId('warehouse_location_id')->nullable()->constrained()->onDelete('set null');
            $table->enum('type', ['inbound', 'outbound', 'adjustment'])->comment('Movement type');
            $table->integer('quantity')->comment('Movement quantity');
            $table->integer('previous_stock')->comment('Stock level before movement');
            $table->integer('new_stock')->comment('Stock level after movement');
            $table->string('reference_type')->nullable()->comment('Reference type (purchase_order, sales_order, etc.)');
            $table->unsignedBigInteger('reference_id')->nullable()->comment('Reference ID');
            $table->text('notes')->nullable()->comment('Movement notes');
            $table->timestamp('movement_date')->comment('Movement date and time');
            $table->timestamps();
            
            $table->index('product_id');
            $table->index('warehouse_location_id');
            $table->index('type');
            $table->index('movement_date');
            $table->index(['reference_type', 'reference_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};