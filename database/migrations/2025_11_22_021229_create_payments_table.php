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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('jasa_id')->table('orders')->constrained()->onDelete('cascade');
            $table->string('order_id');
            $table->string('payment_id');
            $table->enum('payment_status', ['berhasil', 'gagal'])->default('berhasil');
            $table->enum('order_status', ['proses', 'kirim', 'selesai'])->default('proses');
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
