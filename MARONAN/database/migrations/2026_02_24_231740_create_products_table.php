<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // Relasi ke users (petani)
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            // Data Produk
            $table->string('name');
            $table->text('description')->nullable();

            $table->enum('category', [
                'rempah',
                'sayur',
                'buah',
                'biji_bijian',
                'umbi_umbian'
            ]);

            $table->decimal('price', 15, 2);
            $table->integer('stock')->default(0);
            $table->string('unit', 20);

            $table->string('image')->nullable();

            $table->enum('status', ['available', 'sold_out'])
                  ->default('available');

            // Kontrol Admin
            $table->boolean('warning_flag')->default(false);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};