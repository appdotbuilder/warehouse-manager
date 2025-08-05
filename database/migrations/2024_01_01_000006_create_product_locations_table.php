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
        Schema::create('product_locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('warehouse_location_id')->constrained()->onDelete('cascade');
            $table->integer('quantity')->default(0)->comment('Quantity at this location');
            $table->timestamps();
            
            $table->unique(['product_id', 'warehouse_location_id']);
            $table->index('product_id');
            $table->index('warehouse_location_id');
            $table->index('quantity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_locations');
    }
};