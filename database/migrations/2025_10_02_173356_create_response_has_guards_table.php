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
        Schema::create('response_has_guards', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('response_id');
            $table->unsignedBigInteger('employee_id');

            $table->foreign('response_id')->references('id')->on('responses')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('response_has_guards');
    }
};
