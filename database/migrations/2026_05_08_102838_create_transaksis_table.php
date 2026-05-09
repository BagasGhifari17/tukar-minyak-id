<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Fungsi: Membuat tabel 'transaksis' di database MySQL kamu.
     */
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            // 1. primary key (ID unik untuk setiap transaksi)
            $table->id();

            // 2. Foreign Key (Kunci Tamu)
            // Menghubungkan tabel ini ke tabel 'users'. 
            // 'onDelete(cascade)' artinya jika akun Bagas dihapus, riwayatnya ikut terhapus otomatis.
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // 3. Kolom Data Minyak
            // Menggunakan float agar user bisa input 1.5 liter atau 2.5 liter.
            $table->float('liter'); 

            // 4. Kolom Hadiah Poin
            // Menggunakan integer karena poin biasanya angka bulat.
            $table->integer('poin');

            // 5. Pencatat Waktu
            // Otomatis membuat kolom 'created_at' dan 'updated_at' (wajib buat fitur Riwayat).
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * Fungsi: Menghapus tabel jika kamu melakukan 'migrate:rollback'.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};