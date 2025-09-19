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

            $table->unsignedBigInteger('location_id');
            // relation
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');

            $table->unsignedBigInteger('area_zone_id');
            // relation
            $table->foreign('area_zone_id')->references('id')->on('area_zones')->onDelete('cascade');
            
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
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
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
