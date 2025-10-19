<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('responses', function (Blueprint $table) {
            $table->dropColumn('transaction_url');
        });
    }

    public function down(): void
    {
        Schema::table('responses', function (Blueprint $table) {
            $table->string('transaction_url')->nullable();
        });
    }
};
