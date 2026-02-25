<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('click_logs', function (Blueprint $table) {
            $table->id();

            // Relasi ke produk
            $table->foreignId('product_id')
                  ->constrained('products')
                  ->onDelete('cascade');

            // Data tracking
            $table->string('ip_address', 45)->nullable();
            $table->timestamp('clicked_at')->useCurrent();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('click_logs');
    }
};