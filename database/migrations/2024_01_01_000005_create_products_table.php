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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Product name');
            $table->string('sku')->unique()->comment('Stock Keeping Unit');
            $table->text('description')->nullable()->comment('Product description');
            $table->decimal('purchase_price', 10, 2)->comment('Purchase price per unit');
            $table->decimal('selling_price', 10, 2)->comment('Selling price per unit');
            $table->integer('stock_quantity')->default(0)->comment('Current stock quantity');
            $table->integer('min_stock_level')->default(0)->comment('Minimum stock level for alerts');
            $table->foreignId('category_id')->constrained()->onDelete('restrict');
            $table->enum('status', ['active', 'inactive'])->default('active')->comment('Product status');
            $table->timestamps();
            
            $table->index('name');
            $table->index('sku');
            $table->index('category_id');
            $table->index('status');
            $table->index('stock_quantity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};