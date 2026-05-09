<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="space-y-4 italic">
            <!-- Name -->
            <div>
                <label class="text-[10px] font-black text-emerald-600 uppercase tracking-widest ml-1">Nama Lengkap</label>
                <x-text-input id="name" class="block mt-1 w-full border-gray-100 focus:ring-emerald-500 focus:border-emerald-500 rounded-2xl font-bold" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Contoh: Bagas Ghifari" />
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-[10px]" />
            </div>

            <!-- Email -->
            <div>
                <label class="text-[10px] font-black text-emerald-600 uppercase tracking-widest ml-1">Alamat Email</label>
                <x-text-input id="email" class="block mt-1 w-full border-gray-100 focus:ring-emerald-500 focus:border-emerald-500 rounded-2xl font-bold" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="email@gmail.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-[10px]" />
            </div>

            <!-- Password -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-[10px] font-black text-emerald-600 uppercase tracking-widest ml-1">Sandi</label>
                    <x-text-input id="password" class="block mt-1 w-full border-gray-100 focus:ring-emerald-500 focus:border-emerald-500 rounded-2xl font-bold" type="password" name="password" required autocomplete="new-password" />
                </div>
                <div>
                    <label class="text-[10px] font-black text-emerald-600 uppercase tracking-widest ml-1">Konfirmasi</label>
                    <x-text-input id="password_confirmation" class="block mt-1 w-full border-gray-100 focus:ring-emerald-500 focus:border-emerald-500 rounded-2xl font-bold" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-[10px]" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-[10px]" />
        </div>

        <div class="mt-8">
            <button class="w-full bg-emerald-600 text-white py-4 rounded-[1.5rem] font-black uppercase tracking-widest hover:bg-[#064e3b] transition-all shadow-xl shadow-emerald-500/20 active:scale-95 italic text-sm">
                Daftar Akun Baru
            </button>

            <a class="block text-center mt-6 text-[10px] font-black text-gray-400 uppercase hover:text-emerald-600 transition-colors" href="{{ route('login') }}">
                Sudah punya akun? Masuk
            </a>
        </div>
    </form>
</x-guest-layout>