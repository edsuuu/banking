<section class="bg-slate-50 rounded-4xl p-8 border border-transparent hover:border-blue-100 transition-all">
    <div class="flex items-center gap-4 mb-8">
        <div class="w-14 h-14 rounded-2xl bg-white flex items-center justify-center text-primary shadow-sm">
            <span class="material-symbols-outlined text-2xl">lock_reset</span>
        </div>
        <div>
            <h3 class="text-xl font-bold text-slate-800">Alterar Senha</h3>
            <p class="text-xs text-slate-400 font-medium mt-1">Recomendamos uma senha forte com símbolos e números.</p>
        </div>
    </div>
    <div class="space-y-6">
        <div class="space-y-2">
            <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Senha Atual</label>
            <div class="relative">
                <input class="w-full bg-white border-slate-100 rounded-2xl px-5 py-3.5 text-sm font-semibold text-slate-700 focus:ring-primary focus:border-primary transition-all pr-12" placeholder="••••••••••••" type="password"/>
                <button class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 hover:text-primary transition-colors">
                    <span class="material-symbols-outlined text-lg">visibility</span>
                </button>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Nova Senha</label>
                <input class="w-full bg-white border-slate-100 rounded-2xl px-5 py-3.5 text-sm font-semibold text-slate-700 focus:ring-primary focus:border-primary transition-all" placeholder="No mínimo 8 caracteres" type="password"/>
            </div>
            <div class="space-y-2">
                <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Confirmar Nova Senha</label>
                <input class="w-full bg-white border-slate-100 rounded-2xl px-5 py-3.5 text-sm font-semibold text-slate-700 focus:ring-primary focus:border-primary transition-all" placeholder="Repita a nova senha" type="password"/>
            </div>
        </div>
    </div>
    <div class="mt-8 flex justify-end">
        <button class="px-8 py-3.5 bg-primary text-white rounded-pill text-xs font-bold shadow-lg shadow-blue-500/20 hover:scale-[1.02] transition-all">
            Atualizar Senha
        </button>
    </div>
</section>
