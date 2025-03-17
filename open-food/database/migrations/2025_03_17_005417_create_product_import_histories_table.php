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
        Schema::create('product_import_histories', function (Blueprint $table) {
            $table->id();
            $table->timestamp('last_executed_at');
            $table->integer('execution_time_seconds');
            $table->integer('memory_usage_bytes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_import_histories');
    }
};
