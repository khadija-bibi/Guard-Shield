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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id(); // Primary key

            // Request reference
            $table->unsignedBigInteger('request_id'); 
            $table->foreign('request_id')
                  ->references('id')
                  ->on('requests')
                  ->onDelete('cascade'); 

            
            $table->integer('total_days')->default(0); 
            $table->integer('month_count')->default(1); 
            $table->decimal('amount', 12, 2)->default(0.00); 

            $table->date('billing_start_date')->nullable(); 
            $table->date('billing_end_date')->nullable();   

            $table->string('attachment')->nullable();

            $table->enum('status', ['PENDING', 'PAID'])
                  ->default('PENDING'); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
