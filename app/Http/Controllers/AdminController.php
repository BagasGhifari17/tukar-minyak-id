<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Tambahkan ini

class AdminController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with('user')->latest()->get();
        // Ambil produk agar bisa diedit di dashboard
        $products = Product::all();
        
        $stats = [
            'total_minyak' => Transaksi::sum('liter'),
            'poin_keluar'  => Transaksi::where('poin', '<', 0)->sum('poin'),
            'total_user'   => User::count(),
        ];
        
        return view('admin.dashboard', compact('transaksis', 'stats', 'products'));
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:1',
            'unit' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $path = $request->hasFile('image') ? $request->file('image')->store('products', 'public') : null;

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'unit' => $request->unit,
            'description' => $request->description,
            'image' => $path,
        ]);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
    }

    // FUNGSI UPDATE PRODUK
    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:1',
            'unit' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->only(['name', 'price', 'unit', 'description']);

        if ($request->hasFile('image')) {
            if ($product->image) Storage::disk('public')->delete($product->image);
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);
        return redirect()->back()->with('success', 'Produk berhasil diperbarui!');
    }

    // FUNGSI HAPUS PRODUK
    public function destroyProduct($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image) Storage::disk('public')->delete($product->image);
        $product->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus!');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $user = $transaksi->user;
        $user->update(['points' => $user->points - $transaksi->poin]);
        $transaksi->delete();

        return redirect()->back()->with('success', 'Transaksi dibatalkan!');
    }
}