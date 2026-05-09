<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="space-y-5 italic">
            <!-- Email Address -->
            <div>
                <label class="text-[10px] font-black text-emerald-600 uppercase tracking-widest ml-1">Email Nasabah</label>
                <x-text-input id="email" class="block mt-1 w-full border-gray-100 focus:ring-emerald-500 focus:border-emerald-500 rounded-2xl font-bold shadow-sm" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="admin@tukarminyak.id" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-[10px]" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label class="text-[10px] font-black text-emerald-600 uppercase tracking-widest ml-1">Kata Sandi</label>
                <x-text-input id="password" class="block mt-1 w-full border-gray-100 focus:ring-emerald-500 focus:border-emerald-500 rounded-2xl font-bold shadow-sm" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-[10px]" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between mt-4 px-1">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded-lg border-gray-200 text-emerald-600 shadow-sm focus:ring-emerald-500" name="remember">
                    <span class="ml-2 text-[10px] font-black text-gray-400 uppercase">Ingat Saya</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="text-[10px] font-black text-emerald-600 hover:text-emerald-800 uppercase" href="{{ route('password.request') }}">
                        Lupa Sandi?
                    </a>
                @endif
            </div>
        </div>

        <div class="mt-8">
            <button class="w-full bg-emerald-600 text-white py-4 rounded-[1.5rem] font-black uppercase tracking-widest hover:bg-[#064e3b] transition-all shadow-xl shadow-emerald-500/20 active:scale-95 italic">
                Masuk Sekarang
            </button>
            
            <p class="text-center mt-6 text-[10px] font-black text-gray-400 uppercase">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-emerald-600 hover:underline">Daftar Nasabah</a>
            </p>
        </div>
    </form>
</x-guest-layout>