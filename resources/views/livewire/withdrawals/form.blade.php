<div class="bg-white w-full max-w-[540px] rounded-5xl shadow-2xl overflow-hidden">
    <!-- Header -->
    <div class="px-10 pt-10 pb-6 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-blue-50 text-primary rounded-2xl flex items-center justify-center">
                <span class="material-symbols-outlined text-2xl fill-icon">account_balance_wallet</span>
            </div>
            <div>
                <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Novo Saque</h2>
                <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Solicite seus fundos</p>
            </div>
        </div>
        <button wire:click="$dispatch('closeModal')" class="w-10 h-10 flex items-center justify-center text-slate-300 hover:text-slate-500 hover:bg-slate-50 rounded-full transition-all cursor-pointer">
            <span class="material-symbols-outlined">close</span>
        </button>
    </div>

    <!-- Content -->
    <div class="px-10 pb-10 space-y-8">
        <!-- Saldo Disponível -->
        <div class="bg-blue-600 rounded-4xl p-6 text-white relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-[10px] font-bold uppercase tracking-[0.2em] opacity-80 mb-1">Disponível para Saque</p>
                <div class="flex items-baseline gap-1">
                    <span class="text-lg font-bold opacity-70">R$</span>
                    <span class="text-3xl font-black">{{ $this->formattedAvailableBalance }}</span>
                </div>
            </div>
            <span class="material-symbols-outlined absolute -bottom-4 -right-4 text-6xl text-white/10 rotate-12">account_balance</span>
        </div>

        <div class="space-y-6">
            <!-- Método de Recebimento -->
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-4">Método de Recebimento</label>
                <div class="grid grid-cols-2 gap-4">
                    @foreach($withdrawalMethods as $method)
                        <label class="relative cursor-pointer group">
                            <input wire:model="withdrawalMethodId" value="{{ $method->id }}" class="peer hidden" name="method" type="radio"/>
                            <div class="p-4 rounded-3xl border-2 border-slate-100 bg-slate-50/50 peer-checked:border-primary peer-checked:bg-blue-50/50 transition-all text-center">
                                <span class="material-symbols-outlined text-slate-400 group-hover:scale-110 transition-transform peer-checked:text-primary block mb-2">
                                    @if($method->code === 'pix') bolt @else account_balance @endif
                                </span>
                                <p class="text-xs font-bold text-slate-600 peer-checked:text-primary">
                                    @if($method->code === 'pix') PIX Instantâneo @else TED Bancária @endif
                                </p>
                            </div>
                        </label>
                    @endforeach
                </div>
                @error('withdrawalMethodId') <span class="text-red-500 text-xs font-bold mt-2 block">{{ $message }}</span> @enderror
            </div>

            <!-- Valor do Saque -->
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Valor do Saque</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-6 flex items-center pointer-events-none">
                        <span class="text-lg font-bold text-slate-400 group-focus-within:text-primary transition-colors">R$</span>
                    </div>
                    <input
                        wire:model="amount"
                        x-data
                        x-on:input="$event.target.value = window.moneyMask($event.target.value, 12)"
                        class="w-full pl-16 pr-6 py-5 bg-slate-50 border-2 border-slate-100 rounded-3xl text-xl font-bold text-slate-800 focus:border-primary focus:ring-0 transition-all"
                        type="text"
                        placeholder="0,00"
                    />
                </div>
                @error('amount') <span class="text-red-500 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
                <div class="flex justify-between mt-3 px-2">
                    <button type="button" class="text-[10px] font-extrabold text-primary uppercase hover:underline cursor-pointer">Mínimo R$ 50,00</button>
                    <button type="button" wire:click="$set('amount', '{{ number_format((float) $this->availableBalance, 2, ',', '.') }}')" class="text-[10px] font-extrabold text-primary uppercase hover:underline cursor-pointer">Sacar tudo</button>
                </div>
            </div>
        </div>

        <!-- Botões -->
        <div class="flex flex-col gap-3 pt-4">
            <button
                wire:click="submit"
                class="w-full py-5 bg-primary text-white rounded-pill font-extrabold text-sm shadow-xl shadow-blue-500/30 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-2 cursor-pointer"
            >
                <span wire:loading.remove>Solicitar Saque</span>
                <span wire:loading.remove class="material-symbols-outlined text-lg">trending_flat</span>
                <span wire:loading class="material-symbols-outlined animate-spin text-lg">progress_activity</span>
                <span wire:loading>Processando...</span>
            </button>
            <button
                wire:click="$dispatch('closeModal')"
                class="w-full py-4 text-slate-400 font-bold text-sm hover:text-slate-600 transition-all cursor-pointer"
            >
                Cancelar
            </button>
        </div>
    </div>

    <!-- Footer Info -->
    <div class="px-10 py-6 bg-slate-50 border-t border-slate-100 flex items-center gap-3">
        <span class="material-symbols-outlined text-slate-400 text-lg">info</span>
        <p class="text-[10px] text-slate-500 font-medium leading-relaxed">
            Ao solicitar, os fundos serão transferidos para sua conta cadastrada <b>Banco do Brasil final 6789</b>.
        </p>
    </div>
</div>
