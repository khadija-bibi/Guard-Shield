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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            // relation
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');

            $table->string('location_address');
            $table->decimal('location_lat', 10, 7)->nullable();;
            $table->decimal('location_lng', 10, 7)->nullable();;
            
            $table->string('crewtype');
            $table->text('description',255);
            $table->string('severity');
            $table->date('date_from');
            $table->date('date_to');
            $table->time('time_from')->nullable();
            $table->time('time_to')->nullable();
            $table->unsignedBigInteger('users_id');
            // relation
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('paymentPlan');
            $table->decimal('budget', 12, 2); // e.g. 9999999999.99
            $table->enum('status', [
                'PENDING',
                'RESPONSED',
                'REJECTED',
                'ACCEPTED',
                'CANCELLED',
                'COMPLETED'
            ])->default('PENDING');
            $table->enum('payment_status', [
                'PENDING',
                'DONE',
                'REFUND',
            ])->default('PENDING');
            $table->timestamps();
            

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
