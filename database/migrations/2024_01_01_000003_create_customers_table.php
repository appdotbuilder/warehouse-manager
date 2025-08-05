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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Customer name');
            $table->string('phone')->nullable()->comment('Customer phone number');
            $table->string('email')->nullable()->comment('Customer email address');
            $table->text('shipping_address')->nullable()->comment('Customer shipping address');
            $table->enum('status', ['active', 'inactive'])->default('active')->comment('Customer status');
            $table->timestamps();
            
            $table->index('name');
            $table->index('email');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};