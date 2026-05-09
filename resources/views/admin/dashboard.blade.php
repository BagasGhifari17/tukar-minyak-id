<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-emerald-800 leading-tight">🚀 Panel Kontrol Admin</h2>
    </x-slot>

    <div class="py-12" x-data="{ editModal: false, currentProduct: {} }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- 1. KARTU STATISTIK -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-emerald-100">
                    <p class="text-sm text-gray-500 font-bold uppercase italic">Total Minyak Terkumpul</p>
                    <h3 class="text-3xl font-black text-emerald-600">{{ $stats['total_minyak'] }} <span class="text-lg font-normal">Liter</span></h3>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-red-100">
                    <p class="text-sm text-gray-500 font-bold uppercase italic">Poin Telah Ditukar</p>
                    <h3 class="text-3xl font-black text-red-500">{{ abs($stats['poin_keluar']) }} <span class="text-lg font-normal">Poin</span></h3>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-blue-100">
                    <p class="text-sm text-gray-500 font-bold uppercase italic">Total Nasabah</p>
                    <h3 class="text-3xl font-black text-blue-600">{{ $stats['total_user'] }} <span class="text-lg font-normal">Orang</span></h3>
                </div>
            </div>

            <!-- 2. FORM INPUT SETORAN MINYAK -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl p-8 mb-8 border border-emerald-500/20 bg-gradient-to-r from-emerald-50 to-white">
                <div class="flex items-center gap-3 mb-6">
                    <div class="bg-emerald-600 p-2 rounded-xl text-white text-xl shadow-lg shadow-emerald-600/20">📝</div>
                    <h3 class="text-xl font-black text-emerald-900 uppercase tracking-tight italic">Input Setoran Minyak Nasabah</h3>
                </div>
                <form action="{{ route('minyak.setor') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 font-bold italic">
                        <div class="space-y-2">
                            <label class="text-[10px] text-emerald-600 uppercase tracking-widest">Pilih Nasabah</label>
                            <select name="user_id" class="w-full rounded-xl border-gray-100 focus:ring-emerald-500 focus:border-emerald-500 font-bold" required>
                                <option value="" disabled selected>Cari nama nasabah...</option>
                                @foreach(\App\Models\User::all() as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] text-emerald-600 uppercase tracking-widest">Jumlah Liter</label>
                            <input type="number" step="0.1" name="liter" placeholder="Contoh: 5.5" class="w-full rounded-xl border-gray-100 focus:ring-emerald-500 focus:border-emerald-500 font-bold" required>
                        </div>
                        <div class="flex items-end">
                            <button type="submit" class="w-full bg-emerald-600 text-white py-3 rounded-xl font-black uppercase tracking-widest hover:bg-emerald-700 transition shadow-lg shadow-emerald-600/20 italic text-xs">
                                Proses & Tambah Poin
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- 3. FORM TAMBAH PRODUK BARU -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl p-8 mb-8 border border-emerald-100">
                <div class="flex items-center gap-3 mb-6">
                    <div class="bg-emerald-100 p-2 rounded-xl text-emerald-600 text-xl">🛡️</div>
                    <h3 class="text-xl font-black text-gray-800 uppercase tracking-tight italic">Tambah Produk Sembako Baru</h3>
                </div>
                <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 font-bold italic">
                        <div class="space-y-2">
                            <label class="text-[10px] text-emerald-600 uppercase tracking-widest">Nama Produk</label>
                            <input type="text" name="name" placeholder="Beras Premium" class="w-full rounded-xl border-gray-100 focus:ring-emerald-500 focus:border-emerald-500" required>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] text-emerald-600 uppercase tracking-widest">Unit</label>
                            <input type="text" name="unit" placeholder="5kg bag" class="w-full rounded-xl border-gray-100 focus:ring-emerald-500 focus:border-emerald-500" required>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] text-emerald-600 uppercase tracking-widest">Harga (Poin)</label>
                            <input type="number" name="price" placeholder="10" class="w-full rounded-xl border-gray-100 focus:ring-emerald-500 focus:border-emerald-500" required>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] text-emerald-600 uppercase tracking-widest">Gambar</label>
                            <input type="file" name="image" class="w-full text-[10px]">
                        </div>
                        <div class="md:col-span-2 lg:col-span-3 space-y-2">
                            <label class="text-[10px] text-emerald-600 uppercase tracking-widest">Deskripsi</label>
                            <input type="text" name="description" placeholder="Deskripsi singkat..." class="w-full rounded-xl border-gray-100 focus:ring-emerald-500 focus:border-emerald-500">
                        </div>
                        <div class="lg:col-span-1 flex items-end">
                            <button type="submit" class="w-full bg-emerald-600 text-white py-3 rounded-xl font-black uppercase tracking-widest hover:bg-emerald-700 transition shadow-lg shadow-emerald-600/20 italic text-xs">
                                Simpan Produk
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- 4. KELOLA KATALOG PRODUK (VERSI MODAL) -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl p-8 mb-8 border border-gray-100">
                <div class="flex items-center gap-3 mb-8">
                    <div class="bg-emerald-100 p-2 rounded-xl text-emerald-600 text-xl font-bold italic">📦</div>
                    <h3 class="text-xl font-black text-gray-800 uppercase tracking-tight italic">Edit & Kelola Katalog</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach(\App\Models\Product::all() as $product)
                    <div class="bg-white border-2 border-gray-50 rounded-[2.5rem] p-6 hover:border-emerald-100 transition-all duration-300 relative group">
                        <div class="flex flex-col items-center text-center">
                            <div class="w-24 h-24 bg-gray-50 rounded-3xl overflow-hidden mb-4 shadow-inner border border-gray-100">
                                @if($product->image)
                                    <img src="{{ asset('storage/'.$product->image) }}" class="object-cover w-full h-full">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-3xl">🍲</div>
                                @endif
                            </div>
                            
                            <h4 class="text-lg font-black text-gray-800 uppercase tracking-tighter">{{ $product->name }}</h4>
                            <div class="flex items-center gap-2 mt-1 font-bold italic">
                                <span class="bg-emerald-50 text-emerald-600 px-3 py-0.5 rounded-lg text-[10px] uppercase">{{ $product->price }} POIN</span>
                                <span class="text-[10px] font-bold text-gray-400 uppercase italic">{{ $product->unit }}</span>
                            </div>

                            <div class="flex gap-2 mt-6 w-full">
                                <button @click="editModal = true; currentProduct = { id: '{{ $product->id }}', name: '{{ $product->name }}', price: '{{ $product->price }}', unit: '{{ $product->unit }}', description: '{{ $product->description }}' }" 
                                        class="flex-1 bg-gray-100 text-gray-600 py-2.5 rounded-xl text-[10px] font-black uppercase hover:bg-emerald-600 hover:text-white transition-all italic">
                                    Edit Produk
                                </button>
                                
                                <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')" class="flex-none">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="bg-red-50 text-red-500 p-2.5 rounded-xl hover:bg-red-500 hover:text-white transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- 5. RIWAYAT TRANSAKSI GLOBAL -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl p-8 border border-gray-100">
                <div class="flex items-center gap-3 mb-6">
                    <div class="bg-gray-100 p-2 rounded-xl text-gray-600 text-xl">📜</div>
                    <h3 class="text-xl font-black text-gray-800 uppercase tracking-tight italic">Riwayat Transaksi Global</h3>
                </div>
                <div class="overflow-x-auto border border-gray-50 rounded-2xl">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-gray-50 text-gray-600 font-black uppercase tracking-widest text-[10px]">
                            <tr>
                                <th class="px-6 py-5">Nasabah</th>
                                <th class="px-6 py-5">Aktivitas</th>
                                <th class="px-6 py-5 text-right">Poin</th>
                                <th class="px-6 py-5 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($transaksis as $log)
                            <tr class="hover:bg-gray-50/50 transition font-bold italic">
                                <td class="px-6 py-5">
                                    <div class="font-black text-gray-800 uppercase tracking-tight">{{ $log->user->name }}</div>
                                    <div class="text-[10px] text-gray-400 uppercase tracking-widest italic">{{ $log->created_at->format('d M, H:i') }}</div>
                                </td>
                                <td class="px-6 py-5 uppercase text-[10px]">
                                    @if($log->poin > 0)
                                        <span class="text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-100 tracking-tighter">Setor {{ $log->liter }}L</span>
                                    @else
                                        <span class="text-red-600 bg-red-50 px-3 py-1 rounded-full border border-red-100 tracking-tighter">Tukar Barang</span>
                                    @endif
                                </td>
                                <td class="px-6 py-5 text-right font-black {{ $log->poin > 0 ? 'text-emerald-600' : 'text-red-500' }} text-lg">
                                    {{ $log->poin > 0 ? '+' : '' }}{{ $log->poin }}
                                </td>
                                <td class="px-6 py-5 text-center">
                                    <form action="{{ route('admin.transaksi.destroy', $log->id) }}" method="POST" onsubmit="return confirm('Batalkan transaksi ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-gray-300 hover:text-red-600 transition p-2"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- MODAL EDIT PRODUK (POP-UP) -->
        <div x-show="editModal" class="fixed inset-0 z-50 overflow-y-auto bg-black/60 backdrop-blur-sm flex items-center justify-center p-4" x-cloak>
            <div @click.away="editModal = false" class="bg-white w-full max-w-md rounded-[2.5rem] p-8 shadow-2xl">
                <div class="flex justify-between items-center mb-6 font-black italic uppercase">
                    <h3 class="text-xl text-gray-800">Edit Data Produk</h3>
                    <button @click="editModal = false" class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
                </div>
                <form :action="'/admin/product/' + currentProduct.id" method="POST" enctype="multipart/form-data">
                    @csrf @method('PATCH')
                    <div class="space-y-4 italic font-bold">
                        <div>
                            <label class="text-[10px] text-emerald-600 uppercase">Nama Produk</label>
                            <input type="text" name="name" x-model="currentProduct.name" class="w-full rounded-xl border-gray-100 mt-1">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-[10px] text-emerald-600 uppercase">Harga (Poin)</label>
                                <input type="number" name="price" x-model="currentProduct.price" class="w-full rounded-xl border-gray-100 mt-1">
                            </div>
                            <div>
                                <label class="text-[10px] text-emerald-600 uppercase">Satuan (Unit)</label>
                                <input type="text" name="unit" x-model="currentProduct.unit" class="w-full rounded-xl border-gray-100 mt-1">
                            </div>
                        </div>
                        <div>
                            <label class="text-[10px] text-emerald-600 uppercase tracking-widest">Deskripsi</label>
                            <input type="text" name="description" x-model="currentProduct.description" class="w-full rounded-xl border-gray-100 mt-1">
                        </div>
                        <div>
                            <label class="text-[10px] text-emerald-600 uppercase tracking-widest">Ganti Gambar (Opsional)</label>
                            <input type="file" name="image" class="w-full text-xs mt-1">
                        </div>
                        <button type="submit" class="w-full bg-emerald-600 text-white py-4 rounded-2xl font-black uppercase tracking-widest mt-4 shadow-lg shadow-emerald-600/20 active:scale-95 transition-transform italic">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>