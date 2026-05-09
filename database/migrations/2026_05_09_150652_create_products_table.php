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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama produk (Beras, Mie, dll)
            $table->text('description')->nullable(); // Deskripsi singkat
            $table->string('image')->nullable(); // Path untuk simpan gambar produk
            $table->integer('price'); // Harga dalam satuan Poin
            $table->string('unit')->default('pack'); // Keterangan satuan (misal: 5kg bag, 1 liter pouch)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};