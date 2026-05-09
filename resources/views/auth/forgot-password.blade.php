<x-guest-layout>
    <div class="mb-6 text-[11px] font-bold text-gray-500 uppercase italic leading-relaxed text-center">
        {{ __('Lupa sandi? Tenang, masukkan email kamu dan kami akan kirimkan link reset melalui kotak masuk.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="italic">
            <label class="text-[10px] font-black text-emerald-600 uppercase tracking-widest ml-1">Email Terdaftar</label>
            <x-text-input id="email" class="block mt-1 w-full border-gray-100 focus:ring-emerald-500 focus:border-emerald-500 rounded-2xl font-bold" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-[10px]" />
        </div>

        <div class="mt-8 space-y-4">
            <button class="w-full bg-emerald-600 text-white py-4 rounded-[1.5rem] font-black uppercase tracking-widest hover:bg-[#064e3b] transition-all shadow-xl shadow-emerald-500/20 italic">
                Kirim Link Reset
            </button>
            
            <a href="{{ route('login') }}" class="block text-center text-[10px] font-black text-gray-400 uppercase hover:text-emerald-600 transition-colors italic">
                Kembali ke Login
            </a>
        </div>
    </form>
</x-guest-layout>