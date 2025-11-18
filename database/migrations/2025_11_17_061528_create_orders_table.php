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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('nama_produk');
            $table->integer('qty');
            $table->decimal('total_harga', 10, 2);
            $table->string('nama_penerima');
            $table->char('no_telp', 13);
            $table->string('alamat');
            $table->enum('ekspedisi', ['JNE', 'J%T', 'Sicepat', 'AnterAja'])->default('JNE');
            $table->enum('status', ['pending', 'paid', 'failed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
