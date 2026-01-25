<x-guest-layout>

        <div
            class="max-w-[500px] mt-20 w-full bg-white p-10 md:p-14 rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 mx-auto"
            x-data="{ recovery: false }">
            <div class="text-center mb-b">
                <div
                    class="w-16 h-16 bg-blue-50 text-primary rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <span class="material-symbols-outlined text-3xl fill-icon" x-show="!recovery">phonelink_lock</span>
                    <span class="material-symbols-outlined text-3xl fill-icon" x-show="recovery">key</span>
                </div>
                <h1 class="text-2xl font-extrabold tracking-tight mb-4 text-slate-800">Verificação</h1>
                <p class="text-slate-500 font-medium" x-show="!recovery">Por favor, confirme o acesso inserindo o código
                    de autenticação gerado pelo seu aplicativo.</p>
                <p class="text-slate-500 font-medium" x-show="recovery">Por favor, confirme o acesso inserindo um dos
                    seus códigos de recuperação de emergência.</p>
            </div>

            <form method="POST" action="{{ route('two-factor.login') }}" class="space-y-6">
                @csrf

                <div x-show="!recovery">
                    <label class="block text-sm font-bold text-slate-700 mb-2 ml-2">Código de Autenticação</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-slate-400">dialpad</span>
                        <input name="code" autofocus autocomplete="one-time-code"
                               class="form-input-custom pl-14 @error('code') error @enderror" placeholder="000000"
                               type="text" x-ref="code"
                               oninput="this.value = this.value.replace(/[^0-9]/g, ''); if(this.value.length === 6) this.form.submit();"/>
                    </div>
                    @error('code') <span
                        class="text-red-500 text-xs mt-1 ml-2 font-bold">{{ $message }}</span> @enderror
                </div>

                <div x-show="recovery" x-cloak>
                    <label class="block text-sm font-bold text-slate-700 mb-2 ml-2">Código de Recuperação</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-slate-400">vpn_key</span>
                        <input name="recovery_code" autocomplete="one-time-code"
                               class="form-input-custom pl-14 @error('recovery_code') error @enderror"
                               placeholder="abc-def-ghi" type="text" x-ref="recovery_code"/>
                    </div>
                    @error('recovery_code') <span
                        class="text-red-500 text-xs mt-1 ml-2 font-bold">{{ $message }}</span> @enderror
                </div>

                <button
                    class="w-full bg-primary hover:bg-blue-700 text-white py-5 rounded-full font-bold text-lg shadow-xl shadow-primary/30 transition-all transform hover:scale-[1.02] active:scale-[0.98] flex items-center justify-center gap-2"
                    type="submit">
                    <span>Verificar Código</span>
                    <span class="material-symbols-outlined">verified</span>
                </button>

                <div class="text-center mt-6">
                    <button type="button" class="text-sm font-bold text-primary hover:underline transition-all"
                            x-show="!recovery"
                            @click="recovery = true; $nextTick(() => { $refs.recovery_code.focus() })">
                        Usar um código de recuperação
                    </button>

                    <button type="button" class="text-sm font-bold text-primary hover:underline transition-all"
                            x-show="recovery"
                            @click="recovery = false; $nextTick(() => { $refs.code.focus() })">
                        Usar um código de autenticação
                    </button>
                </div>
            </form>
        </div>

</x-guest-layout>
