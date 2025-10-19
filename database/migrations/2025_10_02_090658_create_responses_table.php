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
        Schema::create('responses', function (Blueprint $table) {
            $table->id();
            
            // Foreign keys
            $table->unsignedBigInteger('request_id');
            $table->unsignedBigInteger('company_id');
            
            // Other fields
            $table->text('description')->nullable();
            $table->decimal('quotation', 10, 2);
            
            $table->timestamps();
            
            // Foreign key constraints
            $table->foreign('request_id')->references('id')->on('requests')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('responses');
    }
};
