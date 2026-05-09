<nav x-data="{ open: false, userDropdown: false }" class="bg-[#064e3b] border-b border-white/10 shadow-lg">
    <!-- Menu Navigasi Utama -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <!-- Logo TukarMinyak.Id -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                        <div class="bg-emerald-500 p-2.5 rounded-2xl shadow-lg shadow-emerald-500/20 group-hover:scale-110 transition-transform duration-300">
                            <!-- Ikon Tetesan Minyak / Drop -->
                            <svg class="w-6 h-6 text-emerald-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg>
                        </div>
                        <span class="text-white font-black text-2xl tracking-tighter uppercase italic">TUKARMINYAK.ID</span>
                    </a>
                </div>

                <!-- Link Navigasi (Desktop) -->
                <div class="hidden space-x-4 sm:-my-px sm:ml-12 sm:flex">
                    <a href="{{ route('dashboard') }}" 
                       class="inline-flex items-center px-4 py-2 text-sm font-black uppercase tracking-widest transition duration-150 ease-in-out {{ request()->routeIs('dashboard') ? 'text-white border-b-4 border-emerald-400' : 'text-emerald-100/60 hover:text-white' }}">
                        Beranda
                    </a>
                    <a href="{{ route('minyak.riwayat') }}" 
                       class="inline-flex items-center px-4 py-2 text-sm font-black uppercase tracking-widest transition duration-150 ease-in-out {{ request()->routeIs('minyak.riwayat') ? 'text-white border-b-4 border-emerald-400' : 'text-emerald-100/60 hover:text-white' }}">
                        Riwayat
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown (Desktop) - REVISI FULL KUSTOM -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <div class="relative">
                    <!-- Button Trigger -->
                    <button @click="userDropdown = !userDropdown" @click.away="userDropdown = false"
                            class="inline-flex items-center px-4 py-2.5 border border-white/10 text-sm font-black rounded-2xl text-white bg-white/5 hover:bg-white/10 focus:outline-none transition-all duration-200 group">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-xl bg-emerald-500 flex items-center justify-center text-emerald-900 text-xs font-black shadow-lg shadow-emerald-500/20">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <span class="capitalize tracking-tight">{{ Auth::user()->name }}</span>
                        </div>
                        <div class="ml-2 transition-transform duration-200" :class="{'rotate-180': userDropdown}">
                            <svg class="fill-current h-4 w-4 text-emerald-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>

                    <!-- Dropdown Menu (Full Kustom) -->
                    <div x-show="userDropdown" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-0 mt-3 w-56 origin-top-right rounded-2xl bg-[#064e3b] border border-white/10 shadow-2xl z-50 overflow-hidden" 
                         x-cloak>
                        
                        <div class="py-2">
                            <div class="px-4 py-3 border-b border-white/5 mb-1">
                                <p class="text-[10px] font-black text-emerald-400 uppercase tracking-widest leading-none mb-1 italic">Nasabah</p>
                                <p class="text-xs text-white/50 truncate font-bold uppercase tracking-tighter">{{ Auth::user()->email }}</p>
                            </div>

                            <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-sm font-black text-emerald-100 hover:bg-emerald-500 hover:text-emerald-900 transition-colors uppercase italic">
                                Profil Saya
                            </a>

                            @if(Auth::user()->email == 'mieayamgokil@polije.com')
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 text-sm font-black text-yellow-300 hover:bg-yellow-300 hover:text-yellow-900 transition-colors uppercase italic border-t border-white/5">
                                    Panel Admin 🛡️
                                </a>
                            @endif

                            <div class="border-t border-white/5 my-1"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-3 text-sm font-black text-red-400 hover:bg-red-500 hover:text-white transition-colors uppercase italic">
                                    Keluar Akun
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2.5 rounded-xl text-emerald-100 bg-white/5 border border-white/10 hover:bg-white/10 transition duration-150">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menu Navigasi Responsif (Mobile) -->
    <div x-show="open" x-transition class="sm:hidden bg-[#043d2e] border-t border-white/10" x-cloak>
        <div class="pt-2 pb-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="rounded-xl font-bold text-emerald-100">
                Beranda
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('minyak.riwayat')" :active="request()->routeIs('minyak.riwayat')" class="rounded-xl font-bold text-emerald-100">
                Riwayat
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-white/10">
            <div class="px-6 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-emerald-500 flex items-center justify-center text-emerald-900 font-black">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <div class="font-black text-base text-white capitalize">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-emerald-400/60 italic">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-4 space-y-1 px-4 pb-4">
                <x-responsive-nav-link :href="route('profile.edit')" class="rounded-xl text-emerald-100"> Profil </x-responsive-nav-link>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="rounded-xl text-red-300">
                        Keluar
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>