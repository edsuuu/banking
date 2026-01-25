<div class="fixed inset-0 z-50 flex items-center justify-center p-4 modal-overlay overflow-y-auto">
    <div class="bg-white w-full max-w-xl rounded-4xl shadow-2xl overflow-hidden border border-slate-100 my-auto">
        <div class="px-8 pt-8 pb-4 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-50 text-primary rounded-2xl flex items-center justify-center">
                    <span class="material-symbols-outlined fill-icon text-2xl">verified_user</span>
                </div>
                <div>
                    <h3 class="text-xl font-black text-slate-800">Autenticação 2FA</h3>
                    <p class="text-xs text-slate-400 font-medium">Camada extra de segurança</p>
                </div>
            </div>
            <button wire:click="close" class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-slate-100 transition-colors text-slate-400">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <div class="px-8 pb-8">
            @if (!$confirmed && !$isPending)
                {{-- 2FA is not enabled at all --}}
                <div class="space-y-6">
                    <div class="bg-blue-50/50 rounded-3xl p-6 border border-blue-100/50 text-center">
                        <p class="text-sm text-slate-600 leading-relaxed font-medium">
                            A autenticação de dois fatores adiciona uma camada adicional de segurança à sua conta, exigindo um código de seis dígitos gerado pelo seu aplicativo autenticador.
                        </p>
                    </div>
                    <button wire:click="enable" class="w-full py-4 bg-primary text-white rounded-pill font-bold shadow-lg shadow-blue-500/20 hover:scale-[1.01] transition-all">
                        Ativar Agora
                    </button>
                </div>
            @elseif ($isPending)
                {{-- 2FA is enabled in DB but needs confirmation code --}}
                <div class="space-y-6">
                    <div class="text-center">
                        <div class="inline-block p-4 bg-white border-2 border-slate-100 rounded-3xl mb-6">
                            {!! auth()->user()->twoFactorQrCodeSvg() !!}
                        </div>
                        <p class="text-sm text-slate-600 font-medium mb-6">
                            Escaneie este código QR com o seu aplicativo autenticador e insira o código gerado para confirmar.
                        </p>
                    </div>

                    <div class="space-y-4">
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest text-center">Código de Confirmação</label>
                        <input wire:model="code" class="w-full h-14 bg-slate-50 border-slate-100 rounded-2xl text-center text-xl font-bold text-primary focus:ring-primary focus:border-primary focus:bg-white transition-all" maxlength="6" placeholder="000000"/>
                        @error('code') <span class="text-red-500 text-[10px] font-bold block text-center mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex gap-4">
                        <button wire:click="disable" class="flex-1 py-4 text-sm font-bold text-slate-500 hover:bg-slate-50 rounded-pill transition-all">Cancelar</button>
                        <button wire:click="confirm" class="flex-1 py-4 bg-primary text-white rounded-pill font-bold shadow-lg">Confirmar</button>
                    </div>
                </div>
            @elseif ($confirmed)
                {{-- 2FA is fully enabled and confirmed --}}
                <div class="space-y-6">
                    @if($showingRecoveryCodes)
                        <div class="flex items-center gap-4 bg-green-50 p-6 rounded-3xl border border-green-100">
                            <div class="w-12 h-12 bg-green-500 text-white rounded-2xl flex items-center justify-center shrink-0 shadow-lg shadow-green-200">
                                <span class="material-symbols-outlined text-2xl">check_circle</span>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-green-800">2FA Ativado!</h4>
                                <p class="text-xs text-green-700/80 font-medium">Sua conta agora está protegida.</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <p class="text-xs text-slate-500 font-bold uppercase tracking-widest text-center">Códigos de Recuperação</p>
                            <div class="grid grid-cols-2 gap-2 bg-slate-50 p-6 rounded-3xl border border-slate-100">
                                @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes), true) as $recoveryCode)
                                    <code class="text-xs text-slate-700 font-mono text-center">{{ $recoveryCode }}</code>
                                @endforeach
                            </div>
                            <p class="text-[10px] text-slate-400 italic text-center leading-relaxed">
                                Guarde estes códigos em um lugar seguro.
                            </p>
                        </div>
                    @else
                        <div class="bg-blue-50/50 rounded-3xl p-6 border border-blue-100/50 text-center">
                            <p class="text-sm text-slate-600 leading-relaxed font-medium">
                                A autenticação de dois fatores está atualmente <span class="text-primary font-bold">ativa</span> em sua conta.
                            </p>
                        </div>
                    @endif

                    <div class="flex gap-4">
                        <button wire:click="regenerateRecoveryCodes" class="flex-1 py-4 bg-slate-50 text-slate-600 text-sm font-bold rounded-pill hover:bg-slate-100 transition-all border border-slate-200">Novos Códigos</button>
                        <button wire:click="disable" class="flex-1 py-4 bg-red-50 text-red-600 text-sm font-bold rounded-pill hover:bg-red-600 hover:text-white transition-all border border-red-100">Desativar 2FA</button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
