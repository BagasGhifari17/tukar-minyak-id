<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaksi; 
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class MinyakController extends Controller
{
    /**
     * Menampilkan Dashboard User
     */
    public function index()
    {
        $products = Product::all();
        
        $stats = [
            'total_minyak' => Transaksi::sum('liter'),
            'poin_keluar'  => Transaksi::where('poin', '<', 0)->sum('poin'),
            'total_user'   => User::count(),
        ];

        return view('dashboard', compact('products', 'stats'));
    }

    /**
     * REVISI: Fungsi Setor Minyak (Sekarang dihandle Admin)
     */
    public function setor(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'user_id' => 'required|exists:users,id', // Harus ada user yang dipilih
            'liter'   => 'required|numeric|min:0.1',
        ]);

        // 2. Cari Nasabah berdasarkan ID yang dikirim Admin
        $user = User::findOrFail($request->user_id);
        $poinBaru = $request->liter; 

        // 3. Update Poin Nasabah tersebut
        $user->update([
            'points' => $user->points + $poinBaru
        ]);

        // 4. Catat Transaksi
        Transaksi::create([
            'user_id' => $user->id,
            'liter'   => $request->liter,
            'poin'    => $poinBaru,
        ]);

        // 5. Kembali dengan pesan sukses ke Admin
        return redirect()->back()->with('success', "Berhasil! Nasabah " . $user->name . " mendapatkan +" . $poinBaru . " Poin.");
    }

    /**
     * Fungsi Tukar Barang (Tetap dilakukan oleh User di Dashboard mereka)
     */
    public function tukarBarang(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'item' => 'required|exists:products,id',
            'qty'  => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->item);
        $totalHarga = $product->price * $request->qty;

        if ($user->points < $totalHarga) {
            $kurang = $totalHarga - $user->points;
            return redirect()->back()->with('error', "Poin tidak cukup! Butuh $totalHarga, kurang $kurang poin.");
        }

        // Catat transaksi penukaran
        Transaksi::create([
            'user_id' => $user->id,
            'liter'   => 0,
            'poin'    => -$totalHarga,
        ]);

        // Potong poin user
        $user->update([
            'points' => $user->points - $totalHarga
        ]);

        return redirect()->back()->with('success', "Berhasil menukar " . $request->qty . " " . $product->name);
    }

    public function riwayat()
    {
        $transaksis = Auth::user()->transaksis()->latest()->get();
        return view('riwayat', compact('transaksis'));
    }
}