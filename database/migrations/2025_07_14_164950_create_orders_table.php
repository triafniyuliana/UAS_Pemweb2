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
            $table->string('order_id'); // ID pesanan dari Hub (bukan ID Laravel)
            $table->unsignedBigInteger('product_id');
            $table->string('customer_name');
            $table->string('email')->nullable(); // kalau Hub kirim email
            $table->integer('quantity');
            $table->decimal('total_price', 12, 2);
            $table->string('status')->default('pending'); // pending, paid, shipped
            $table->text('address')->nullable(); // alamat pengiriman
            $table->timestamps();

            // Relasi ke tabel produk
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
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
