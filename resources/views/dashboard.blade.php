<x-app-layout>
    <style>
        .card-lifting { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .card-lifting:hover { transform: translateY(-8px); box-shadow: 0 20px 40px rgba(6, 78, 59, 0.12); border-color: #10b981; }
        .btn-interact { transition: all 0.2s ease; }
        .btn-interact:hover { letter-spacing: 1px; filter: brightness(1.1); }
        .btn-interact:active { transform: scale(0.95); }
    </style>

    <!-- BANNER UTAMA DENGAN GRADASI NYATA & SPOTLIGHT -->
    <div class="relative overflow-hidden bg-[#064e3b] pt-12 pb-28 px-4 sm:px-6 lg:px-8">
        <!-- Background Gradasi kompleks agar terlihat nyata -->
        <div class="absolute inset-0 bg-gradient-to-br from-[#064e3b] via-[#064e3b] to-[#0d9488] opacity-90"></div>
        
        <!-- Ornamen Pendaran Cahaya Spotlight -->
        <div class="absolute -right-20 -top-20 w-[600px] h-[600px] bg-emerald-400/20 rounded-full blur-[130px]"></div>
        <div class="absolute -left-20 -bottom-20 w-[400px] h-[400px] bg-teal-500/10 rounded-full blur-[100px]"></div>

        <div class="relative z-10 max-w-7xl mx-auto flex flex-col lg:flex-row justify-between items-center gap-12">
            <!-- Sisi Kiri: Judul dan Info -->
            <div class="text-white lg:w-3/5">
                <h1 class="text-6xl font-black tracking-tighter leading-[1.05] uppercase italic">
                    Sistem Penukaran<br>Minyak Jelantah
                </h1>
                <p class="mt-6 text-emerald-100/70 text-lg max-w-xl leading-relaxed italic font-medium">
                    Ubah limbah menjadi berkah. Kumpulkan poin dari minyak jelantah Anda dan tukarkan dengan berbagai kebutuhan pokok.
                </p>
                <div class="flex flex-wrap gap-3 mt-10">
                    <span class="px-5 py-2.5 bg-white/10 backdrop-blur-sm rounded-2xl text-[10px] font-black border border-white/10 italic uppercase tracking-widest shadow-sm">1 Liter = 1 Poin</span>
                    <span class="px-5 py-2.5 bg-white/10 backdrop-blur-sm rounded-2xl text-[10px] font-black border border-white/10 italic uppercase tracking-widest shadow-sm">1 Poin = Rp 5.000</span>
                </div>
            </div>

            <!-- Sisi Kanan: Statistik (Glassmorphism) -->
            <div class="lg:w-2/5 grid grid-cols-2 gap-4 w-full text-white">
                <div class="bg-white/10 backdrop-blur-lg border border-white/20 p-7 rounded-[2.5rem] group transition-all duration-500">
                    <div class="bg-emerald-400/20 w-10 h-10 rounded-2xl flex items-center justify-center mb-4 text-emerald-300">💧</div>
                    <p class="text-emerald-300 text-[9px] font-black uppercase italic tracking-widest leading-none">Minyak Terkumpul</p>
                    <h3 class="text-2xl font-black mt-2">{{ number_format($stats['total_minyak'] ?? 0, 1) }} L</h3>
                </div>
                <div class="bg-white/10 backdrop-blur-lg border border-white/20 p-7 rounded-[2.5rem] group transition-all duration-500">
                    <div class="bg-emerald-400/20 w-10 h-10 rounded-2xl flex items-center justify-center mb-4 text-emerald-300">🪙</div>
                    <p class="text-emerald-300 text-[9px] font-black uppercase italic tracking-widest leading-none">Poin Anda</p>
                    <h3 class="text-2xl font-black mt-2">{{ Auth::user()->points }}</h3>
                </div>
                <div class="bg-white/10 backdrop-blur-lg border border-white/20 p-7 rounded-[2.5rem] group transition-all duration-500 col-span-2">
                    <div class="flex justify-between items-center">
                        <div>
                            <div class="bg-emerald-400/20 w-10 h-10 rounded-2xl flex items-center justify-center mb-4 text-emerald-300">🍃</div>
                            <p class="text-emerald-300 text-[9px] font-black uppercase italic tracking-widest leading-none">Estimasi Saldo Kas</p>
                            <h3 class="text-2xl font-black mt-2">Rp {{ number_format(Auth::user()->points * 5000, 0, ',', '.') }}</h3>
                        </div>
                        <div class="opacity-20 text-5xl group-hover:rotate-12 transition-transform duration-700">💹</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- KONTEN UTAMA: Ditambah RELATIVE Z-20 agar naik di atas banner -->
    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 pb-20">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            
            <!-- KIRI: DOMPET POIN & RIWAYAT -->
            <div class="lg:col-span-4 space-y-8">
                <div class="bg-white rounded-[2.5rem] p-10 shadow-2xl shadow-emerald-900/10 border border-gray-50 h-fit">
                    <div class="flex justify-between items-center mb-10">
                        <div>
                            <p class="text-[10px] font-black text-emerald-600 uppercase tracking-widest italic">Info Saldo</p>
                            <h2 class="text-3xl font-black text-gray-800 tracking-tighter uppercase">Dompet Poin</h2>
                        </div>
                        <div class="bg-gray-100 px-4 py-2 rounded-2xl text-[10px] font-black text-gray-500 uppercase tracking-tighter italic border border-gray-200">
                            {{ Auth::user()->name }}
                        </div>
                    </div>

                    <!-- KARTU SALDO MODERN -->
                    <div class="bg-gradient-to-br from-emerald-500 to-emerald-700 p-8 rounded-[2.5rem] text-white shadow-2xl shadow-emerald-600/40 mb-8 relative overflow-hidden group">
                        <div class="relative z-10">
                            <p class="text-[10px] font-black opacity-80 uppercase tracking-widest italic">Saldo Saat Ini</p>
                            <div class="flex items-baseline gap-2 mt-2">
                                <h3 class="text-7xl font-black leading-none tracking-tighter">{{ Auth::user()->points }}</h3>
                                <span class="text-2xl font-bold opacity-80 italic lowercase">poin</span>
                            </div>
                            <div class="mt-8 pt-6 border-t border-white/20 flex justify-between items-center text-sm font-black italic">
                                Rp {{ number_format(Auth::user()->points * 5000, 0, ',', '.') }}
                                <div class="bg-white/20 p-2 rounded-xl">💳</div>
                            </div>
                        </div>
                        <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-white/10 rounded-full blur-3xl group-hover:scale-125 transition-transform duration-700"></div>
                    </div>

                    <!-- RIWAYAT AKTIVITAS TERAKHIR -->
                    <div class="mt-10">
                        <div class="flex justify-between items-center mb-6 px-2">
                            <h4 class="text-xs font-black text-gray-800 uppercase italic tracking-widest">Aktivitas Terakhir</h4>
                            <a href="{{ route('minyak.riwayat') }}" class="text-[9px] font-black text-emerald-600 uppercase hover:underline">Lihat Semua</a>
                        </div>
                        <div class="space-y-3">
                            @php $myTransactions = isset($transaksis) ? $transaksis : Auth::user()->transaksis()->latest()->take(3)->get(); @endphp
                            @forelse($myTransactions as $log)
                                <div class="flex items-center justify-between p-4 bg-gray-50/50 rounded-2xl border border-gray-100 group transition-all">
                                    <div class="flex items-center gap-3">
                                        <div class="{{ $log->poin > 0 ? 'bg-emerald-100 text-emerald-600' : 'bg-red-100 text-red-600' }} p-2 rounded-xl text-xs">
                                            {!! $log->poin > 0 ? '💧' : '🛍️' !!}
                                        </div>
                                        <div>
                                            <p class="text-[10px] font-black text-gray-800 uppercase leading-none tracking-tighter">{{ $log->poin > 0 ? 'Setor Minyak' : 'Tukar Barang' }}</p>
                                            <p class="text-[9px] font-bold text-gray-400 uppercase italic mt-1 tracking-tighter">{{ $log->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <p class="text-xs font-black {{ $log->poin > 0 ? 'text-emerald-600' : 'text-red-500' }}">
                                        {{ $log->poin > 0 ? '+' : '' }}{{ $log->poin }}
                                    </p>
                                </div>
                            @empty
                                <div class="text-center py-6 bg-gray-50/30 rounded-[2rem] border-2 border-dashed border-gray-100">
                                    <p class="text-[10px] font-black text-gray-300 uppercase italic">Belum ada jejak transaksi</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- BANNER EDUKASI -->
                    <div class="mt-8 relative overflow-hidden bg-[#064e3b] rounded-[2rem] p-6 group cursor-pointer border border-white/10 shadow-lg">
                        <div class="relative z-10 text-white">
                            <p class="text-emerald-400 text-[9px] font-black uppercase tracking-[0.2em] mb-1 italic">Tahukah Kamu?</p>
                            <p class="text-[11px] font-bold italic leading-snug">1 Liter minyak jelantah dapat mencemari 1 juta liter air bersih. Ayo terus setor!</p>
                        </div>
                        <div class="absolute -right-4 -bottom-4 text-5xl opacity-10 group-hover:rotate-12 group-hover:scale-125 transition-all duration-700">🌱</div>
                    </div>
                </div>
            </div>

            <!-- KANAN: KATALOG TUKAR -->
            <div class="lg:col-span-8">
                <div class="bg-white rounded-[2.5rem] p-10 shadow-2xl shadow-emerald-900/10 border border-gray-50 h-full">
                    <div class="flex items-center gap-4 mb-10">
                        <div class="bg-emerald-100 w-12 h-12 rounded-2xl flex items-center justify-center text-emerald-600 text-2xl shadow-inner">📦</div>
                        <div>
                            <p class="text-[10px] font-black text-emerald-600 uppercase tracking-widest leading-none italic">Pilihan Sembako</p>
                            <h2 class="text-3xl font-black text-gray-800 tracking-tighter uppercase">Katalog Penukaran</h2>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @foreach($products as $item)
                        <div class="card-lifting bg-white border-2 border-gray-50 rounded-[2.5rem] p-7 flex flex-col justify-between h-full shadow-sm">
                            <form id="form-tukar-{{ $item->id }}" action="{{ route('minyak.tukarBarang') }}" method="POST">
                                @csrf
                                <input type="hidden" name="item" value="{{ $item->id }}">
                                <div class="flex justify-between items-start mb-6">
                                    <div class="w-28 h-28 bg-gray-50 rounded-3xl flex items-center justify-center overflow-hidden border border-gray-100">
                                        @if($item->image) <img src="{{ asset('storage/'.$item->image) }}" class="object-contain w-full h-full p-2"> @else <span class="text-4xl">🍲</span> @endif
                                    </div>
                                    <span class="bg-emerald-100 text-emerald-800 px-4 py-1.5 rounded-xl text-[10px] font-black uppercase border border-emerald-200 italic shadow-sm">{{ $item->price }} Poin</span>
                                </div>
                                <div class="mb-8">
                                    <h4 class="text-2xl font-black text-gray-800 leading-tight tracking-tighter uppercase italic">{{ $item->name }}</h4>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase mt-1 italic tracking-widest">{{ $item->description ?? $item->unit }}</p>
                                </div>
                                <div class="flex gap-3">
                                    <input type="number" name="qty" id="qty-{{ $item->id }}" value="1" min="1" class="w-20 bg-gray-50 border-none rounded-2xl text-center font-black text-emerald-700 shadow-inner">
                                    <button type="button" onclick="confirmExchange('{{ $item->id }}', '{{ $item->name }}', '{{ $item->price }}')" class="btn-interact flex-1 bg-emerald-600 text-white py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-[#064e3b] transition shadow-lg shadow-emerald-600/20 active:scale-95 italic">Tukarkan</button>
                                </div>
                            </form>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPT INTERAKTIF SWEETALERT -->
    <script>
        function confirmExchange(id, name, price) {
            const qty = document.getElementById('qty-' + id).value;
            const totalPrice = price * qty;

            Swal.fire({
                title: '<span class="font-black uppercase italic tracking-tighter text-[#064e3b]">Konfirmasi Penukaran</span>',
                html: `Kamu yakin mau menukar <b>${qty}x ${name}</b> seharga <b>${totalPrice} Poin</b>?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#059669',
                cancelButtonColor: '#ef4444',
                confirmButtonText: 'YA, TUKAR SEKARANG!',
                cancelButtonText: 'BATAL',
                borderRadius: '2.5rem',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({ 
                        title: 'Memproses...', 
                        didOpen: () => { Swal.showLoading() }, 
                        showConfirmButton: false, 
                        allowOutsideClick: false,
                        borderRadius: '2rem' 
                    });
                    
                    setTimeout(() => { 
                        document.getElementById('form-tukar-' + id).submit(); 
                    }, 800);
                }
            })
        }

        // AUTO-DETEKSI NOTIFIKASI DARI LARAVEL SETELAH REFRESH
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: '<span class="font-black uppercase italic tracking-tighter">BERHASIL!</span>',
                text: "{{ session('success') }}",
                confirmButtonColor: '#059669',
                borderRadius: '2rem',
                timer: 4000
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: '<span class="font-black uppercase italic tracking-tighter">GAGAL!</span>',
                text: "{{ session('error') }}",
                confirmButtonColor: '#ef4444',
                borderRadius: '2rem',
            });
        @endif
    </script>
</x-app-layout>