<x-app-layout>
    <!-- HEADER HALAMAN -->
    <div class="bg-[#064e3b] pt-12 pb-24 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-5xl font-black text-white uppercase italic tracking-tighter">
                Riwayat Aktivitas
            </h1>
            <p class="mt-4 text-emerald-100/60 font-medium italic max-w-2xl">
                Pantau seluruh jejak kontribusi lingkunganmu. Setiap tetes minyak yang kamu setor adalah langkah nyata menuju bumi yang lebih hijau.
            </p>
        </div>
    </div>

    <!-- KONTEN TABEL -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-12 pb-20">
        <div class="bg-white rounded-[3rem] p-8 sm:p-12 shadow-2xl shadow-emerald-900/10 border border-gray-50">
            
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
                <div class="flex items-center gap-4">
                    <div class="bg-emerald-500 p-3 rounded-2xl shadow-lg shadow-emerald-500/20">
                        <svg class="w-6 h-6 text-emerald-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-black text-gray-800 tracking-tighter uppercase leading-none">Log Transaksi</h2>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1 italic">Menampilkan seluruh data setoran & penukaran</p>
                    </div>
                </div>

                <!-- FILTER SEDERHANA -->
                <div class="flex gap-2">
                    <span class="px-4 py-2 bg-emerald-50 text-emerald-700 rounded-xl text-[10px] font-black uppercase italic border border-emerald-100">Total: {{ $transaksis->count() }} Data</span>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-separate border-spacing-y-3">
                    <thead>
                        <tr class="text-[10px] font-black text-emerald-600 uppercase tracking-[0.2em] italic">
                            <th class="px-6 pb-4">Tanggal</th>
                            <th class="px-6 pb-4">Jenis Aktivitas</th>
                            <th class="px-6 pb-4">Detail</th>
                            <th class="px-6 pb-4">Poin</th>
                            <th class="px-6 pb-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksis as $log)
                        <tr class="group hover:bg-emerald-50/30 transition-all duration-300">
                            <td class="px-6 py-5 bg-gray-50/50 group-hover:bg-transparent rounded-l-[2rem] border-y border-l border-transparent group-hover:border-emerald-100">
                                <p class="text-sm font-black text-gray-800 tracking-tighter">{{ $log->created_at->format('d M Y') }}</p>
                                <p class="text-[10px] font-bold text-gray-400 italic">{{ $log->created_at->format('H:i') }} WIB</p>
                            </td>
                            <td class="px-6 py-5 bg-gray-50/50 group-hover:bg-transparent border-y border-transparent group-hover:border-emerald-100">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 {{ $log->poin > 0 ? 'bg-emerald-100 text-emerald-600' : 'bg-red-100 text-red-600' }} rounded-xl flex items-center justify-center text-lg shadow-sm">
                                        {!! $log->poin > 0 ? '💧' : '🛍️' !!}
                                    </div>
                                    <span class="text-xs font-black uppercase italic tracking-tight {{ $log->poin > 0 ? 'text-emerald-700' : 'text-red-600' }}">
                                        {{ $log->poin > 0 ? 'Setoran Minyak' : 'Penukaran Sembako' }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-5 bg-gray-50/50 group-hover:bg-transparent border-y border-transparent group-hover:border-emerald-100">
                                <p class="text-xs font-bold text-gray-600 uppercase italic leading-tight">
                                    {{ $log->poin > 0 ? $log->liter . ' Liter Jelantah' : ($log->product->name ?? 'Produk Sembako') }}
                                </p>
                            </td>
                            <td class="px-6 py-5 bg-gray-50/50 group-hover:bg-transparent border-y border-transparent group-hover:border-emerald-100">
                                <div class="flex items-center gap-1">
                                    <span class="text-lg font-black tracking-tighter {{ $log->poin > 0 ? 'text-emerald-600' : 'text-red-500' }}">
                                        {{ $log->poin > 0 ? '+' : '' }}{{ $log->poin }}
                                    </span>
                                    <span class="text-[9px] font-black text-gray-400 uppercase italic">Poin</span>
                                </div>
                            </td>
                            <td class="px-6 py-5 bg-gray-50/50 group-hover:bg-transparent rounded-r-[2rem] border-y border-r border-transparent group-hover:border-emerald-100 text-right">
                                <button onclick="showDetail('{{ $log->id }}', '{{ $log->poin > 0 ? 'Setoran' : 'Penukaran' }}', '{{ $log->created_at->format('d F Y H:i') }}', '{{ $log->poin }}')" 
                                        class="p-2.5 bg-white border border-gray-100 text-emerald-600 rounded-xl hover:bg-emerald-600 hover:text-white transition-all shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <span class="text-6xl mb-4">📂</span>
                                    <p class="text-sm font-black text-gray-300 uppercase italic tracking-widest">Belum ada jejak aktivitas transaksi</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- SCRIPT DETAIL INTERAKTIF -->
    <script>
        function showDetail(id, type, date, points) {
            Swal.fire({
                title: `<span class="font-black uppercase italic tracking-tighter text-[#064e3b]">Detail ${type}</span>`,
                html: `
                    <div class="text-left space-y-4 p-4 bg-gray-50 rounded-[2rem] border border-gray-100 italic">
                        <div class="flex justify-between border-b border-gray-200 pb-2">
                            <span class="text-[10px] font-black text-gray-400 uppercase">ID Transaksi</span>
                            <span class="text-xs font-black text-gray-800">#TM-${id}</span>
                        </div>
                        <div class="flex justify-between border-b border-gray-200 pb-2">
                            <span class="text-[10px] font-black text-gray-400 uppercase">Waktu</span>
                            <span class="text-xs font-black text-gray-800">${date}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-[10px] font-black text-gray-400 uppercase">Status Poin</span>
                            <span class="text-xs font-black ${points > 0 ? 'text-emerald-600' : 'text-red-500'}">
                                ${points > 0 ? '+' : ''}${points} Poin
                            </span>
                        </div>
                    </div>
                `,
                confirmButtonText: 'TUTUP',
                confirmButtonColor: '#064e3b',
                borderRadius: '2.5rem',
                customClass: {
                    confirmButton: 'rounded-2xl font-black italic uppercase tracking-widest text-[10px] py-4 px-8'
                }
            });
        }
    </script>
</x-app-layout>