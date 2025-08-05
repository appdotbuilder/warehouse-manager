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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->comment('Supplier company name');
            $table->string('contact_person')->nullable()->comment('Contact person name');
            $table->string('phone')->nullable()->comment('Contact phone number');
            $table->string('email')->nullable()->comment('Contact email address');
            $table->text('address')->nullable()->comment('Supplier address');
            $table->enum('status', ['active', 'inactive'])->default('active')->comment('Supplier status');
            $table->timestamps();
            
            $table->index('company_name');
            $table->index('status');
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};