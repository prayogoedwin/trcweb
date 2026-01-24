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
        Schema::create('trade_configs', function (Blueprint $table) {
            $table->id();
            $table->decimal('min_modal', 15, 2)->default(10000);
            $table->decimal('max_modal', 15, 2)->default(5000000);
            $table->decimal('profit_percent', 5, 2)->default(1.00);   // 1% / hari
            $table->decimal('cancel_fee_percent', 5, 2)->default(30.00); // 30%
            $table->time('profit_time')->default('18:00:00');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trade_configs');
    }
};
