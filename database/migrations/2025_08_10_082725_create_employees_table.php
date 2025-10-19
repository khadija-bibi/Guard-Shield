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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name', 45);
            $table->unsignedBigInteger('company_id'); 
            $table->unsignedBigInteger('user_id')->nullable(); 
            $table->unsignedBigInteger('created_by');
            $table->string('phone', 45);
            $table->string('address', 45);
            $table->string('image', 255)->nullable();
            $table->integer('salary');
            $table->string('salary_type', 45);
            $table->string('qualification', 45);
            $table->string('designation', 45);
            $table->string('location', 45)->nullable();
            $table->dateTime('clock_in')->nullable();
            $table->dateTime('clock_out')->nullable();

            $table->foreign('user_id', 'fk_employees_users') // custom naam
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            
            $table->foreign('created_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
