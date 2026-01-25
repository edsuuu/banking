<x-app-layout>
    <flux:main>
        <div class="max-w-[500px] mt-20 w-full bg-white p-10 md:p-14 rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 mx-auto">
            <div class="text-center mb-10">
                <div class="w-16 h-16 bg-blue-50 text-primary rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <span class="material-symbols-outlined text-3xl fill-icon">
                        {{ auth()->user()->two_factor_confirmed_at ? 'phonelink_lock' : 'shield_person' }}
                    </span>
                </div>
                <h1 class="text-2xl font-extrabold tracking-tight mb-4 text-slate-800">Confirmar Identidade</h1>
                <p class="text-slate-500 font-medium">
                    {{ auth()->user()->two_factor_confirmed_at 
                        ? 'Esta é uma área segura. Por favor, insira seu código de autenticação (2FA) para continuar.' 
                        : 'Esta é uma área segura do aplicativo. Por favor, confirme sua senha antes de continuar.' 
                    }}
                </p>
            </div>

            @if(auth()->user()->two_factor_confirmed_at)
                {{-- Form with 2FA code --}}
                <form method="POST" action="{{ route('password.confirm.2fa') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2 ml-2">Código 2FA</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-slate-400">dialpad</span>
                            <input name="code" required autofocus 
                                   class="form-input-custom pl-14 @error('code') error @enderror" 
                                   placeholder="000 000" type="text"
                                   oninput="this.value = this.value.replace(/[^0-9]/g, ''); if(this.value.length === 6) this.form.submit();"/>
                        </div>
                        @error('code') <span class="text-red-500 text-xs mt-1 ml-2 font-bold">{{ $message }}</span> @enderror
                    </div>

                    <button class="w-full bg-primary hover:bg-blue-700 text-white py-5 rounded-full font-bold text-lg shadow-xl shadow-primary/30 transition-all transform hover:scale-[1.02] active:scale-[0.98] flex items-center justify-center gap-2" type="submit">
                        <span>Confirmar Acesso</span>
                        <span class="material-symbols-outlined text-lg">verified</span>
                    </button>
                </form>
            @else
                {{-- Form with Password --}}
                <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2 ml-2">Sua Senha</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-slate-400">lock</span>
                            <input name="password" required autocomplete="current-password" autofocus
                                   class="form-input-custom pl-14 @error('password') error @enderror"
                                   placeholder="Digite sua senha de acesso" type="password"/>
                        </div>
                        @error('password') <span class="text-red-500 text-xs mt-1 ml-2 font-bold">{{ $message }}</span> @enderror
                    </div>

                    <button class="w-full bg-primary hover:bg-blue-700 text-white py-5 rounded-full font-bold text-lg shadow-xl shadow-primary/30 transition-all transform hover:scale-[1.02] active:scale-[0.98] flex items-center justify-center gap-2" type="submit">
                        <span>Confirmar Acesso</span>
                        <span class="material-symbols-outlined text-lg">verified_user</span>
                    </button>
                </form>
            @endif

            @if(!auth()->user()->two_factor_confirmed_at)
                <div class="relative flex items-center gap-4 my-8">
                    <div class="grow border-t border-slate-100"></div>
                    <span class="text-slate-400 text-xs font-bold uppercase tracking-widest">ou</span>
                    <div class="grow border-t border-slate-100"></div>
                </div>

                <a href="{{ route('google.redirect') }}"
                   class="w-full bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 py-4 rounded-2xl font-bold text-base transition-all transform hover:scale-[1.02] active:scale-[0.98] flex items-center justify-center gap-3">
                    <svg height="20" viewBox="0 0 24 24" width="20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"></path>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"></path>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"></path>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"></path>
                    </svg>
                    Confirmar com Google
                </a>
            @endif
        </div>
    </flux:main>
</x-app-layout>
