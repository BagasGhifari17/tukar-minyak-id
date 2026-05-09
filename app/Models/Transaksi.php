<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    /**
     * Mass Assignment
     * Fungsi: Daftar kolom yang diizinkan untuk diisi secara otomatis.
     * Penjelasan: Tanpa ini, Laravel akan memblokir data yang masuk demi keamanan.
     */
    protected $fillable = [
        'user_id',
        'liter',
        'poin',
    ];

    /**
     * Relasi ke User (Inverse)
     * Fungsi: Memberitahu bahwa setiap baris transaksi ini dimiliki oleh satu User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}