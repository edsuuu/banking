<section class="bg-slate-50 rounded-4xl p-8 border border-transparent hover:border-blue-100 transition-all">
    <div class="flex items-center gap-4 mb-8">
        <div class="w-14 h-14 rounded-2xl bg-white flex items-center justify-center text-primary shadow-sm">
            <span class="material-symbols-outlined text-2xl">lock_reset</span>
        </div>
        <div>
            <h3 class="text-xl font-bold text-slate-800">Alterar Senha</h3>
            <p class="text-xs text-slate-400 font-medium mt-1">Sua identidade foi confirmada. Escolha uma nova senha forte abaixo.</p>
        </div>
    </div>

    @if (session()->has('status'))
        <div class="mb-6 p-4 bg-green-50 border border-green-100 text-green-600 rounded-2xl text-xs font-bold flex items-center gap-3">
            <span class="material-symbols-outlined text-sm">check_circle</span>
            {{ session('status') }}
        </div>
    @endif

    <div class="space-y-6">
        <div x-data="{
            newPassword: @entangle('password'),
            score: 0,
            checkStrength() {
                this.score = 0;
                if (this.newPassword.length > 5) this.score++;
                if (this.newPassword.length > 8) this.score++;
                if (/[A-Z]/.test(this.newPassword)) this.score++;
                if (/[0-9]/.test(this.newPassword) || /[^A-Za-z0-9]/.test(this.newPassword)) this.score++;
            }
        }" x-init="checkStrength(); $watch('newPassword', () => checkStrength())">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Nova Senha</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-slate-300">lock_open</span>
                        <input wire:model="password" class="w-full bg-white border-slate-100 rounded-2xl pl-12 pr-5 py-3.5 text-sm font-semibold text-slate-700 focus:ring-primary focus:border-primary transition-all @error('password') border-red-500 @enderror" placeholder="Mínimo 8 caracteres" type="password"/>
                    </div>
                    <div class="flex gap-1 h-1 mt-2 transition-all duration-300">
                        <div class="h-full rounded-full transition-all duration-300"
                             :class="{
                                'w-1/4 bg-red-500': score <= 1 && newPassword.length > 0,
                                'w-2/4 bg-orange-500': score === 2,
                                'w-3/4 bg-yellow-500': score === 3,
                                'w-full bg-green-500': score === 4,
                                'bg-slate-200 w-full': newPassword.length === 0
                             }"></div>
                    </div>
                    @error('password') <span class="text-red-500 text-[10px] font-bold ml-1">{{ $message }}</span> @enderror
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Confirmar Nova Senha</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-slate-300">lock_reset</span>
                        <input wire:model="password_confirmation" class="w-full bg-white border-slate-100 rounded-2xl pl-12 pr-5 py-3.5 text-sm font-semibold text-slate-700 focus:ring-primary focus:border-primary transition-all" placeholder="Repita a nova senha" type="password"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="mt-8 flex justify-end">
        <button wire:click="updatePassword" class="px-8 py-3.5 bg-primary text-white rounded-pill text-xs font-bold shadow-lg shadow-blue-500/20 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center gap-2">
            <span wire:loading.remove>Atualizar Senha</span>
            <span wire:loading>Aguarde...</span>
            <span class="material-symbols-outlined text-sm" wire:loading.remove>check</span>
        </button>
    </div>
</section>
