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
        Schema::create('warehouse_locations', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->comment('Location code (e.g., A1-R2)');
            $table->string('name')->comment('Location name (e.g., Rak A1, Row 2)');
            $table->text('description')->nullable()->comment('Location description');
            $table->enum('status', ['active', 'inactive'])->default('active')->comment('Location status');
            $table->timestamps();
            
            $table->index('code');
            $table->index('name');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouse_locations');
    }
};