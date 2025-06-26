<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->string('nama');
            $table->string('nomor_meja');
            $table->decimal('total_harga', 10, 2);
            $table->text('catatan')->nullable();

            // Relasi ke customers sebagai waiter
            $table->foreignId('waiter_id')->nullable()
                  ->constrained('customers')
                  ->onDelete('set null');

            // Metode pembayaran
            $table->string('metode_pembayaran')->nullable(); // contoh: tunai, qris, e-wallet

            // Status pesanan
            $table->string('status')->nullable();

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