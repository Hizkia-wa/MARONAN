<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Data Dasar
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone', 20);
            $table->string('password');

            // Role
            $table->enum('role', ['admin', 'petani'])->default('petani');

            // Data Umum
            $table->text('address')->nullable();
            $table->string('village', 150)->nullable();

            // Data Khusus Petani
            $table->string('farmer_id_number', 100)->nullable();
            $table->text('farm_address')->nullable();
            $table->string('land_area', 50)->nullable();
            $table->string('main_commodity', 100)->nullable();
            $table->text('commitment_statement')->nullable();
            $table->string('supporting_document')->nullable();

            // Verifikasi
            $table->enum('verification_status', ['pending', 'approved', 'rejected'])
                  ->default('pending');
            $table->text('verification_notes')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->integer('rejection_count')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};