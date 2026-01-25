<div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
    <div class="lg:col-span-8 space-y-6">
        <section class="bg-slate-50 rounded-4xl p-8 border border-transparent hover:border-blue-100 transition-all space-y-6">
            {{-- Vendas Realizadas --}}
            <label class="flex items-center justify-between p-5 bg-white rounded-3xl border border-slate-100 shadow-sm cursor-pointer hover:border-primary/20 transition-all group">
                <div class="flex items-center gap-5">
                    <div class="w-14 h-14 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-2xl fill-icon">payments</span>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-800">Vendas Realizadas</h4>
                        <p class="text-xs text-slate-400 font-medium">Notificar instantaneamente sobre cada nova venda concluída.</p>
                    </div>
                </div>
                <div class="relative inline-flex items-center">
                    <input type="checkbox" wire:model.live="settings.sales_enabled" class="hidden peer">
                    <div class="w-14 h-8 bg-slate-200 peer-checked:bg-primary rounded-full transition-all duration-300 ease-in-out relative after:content-[''] after:absolute after:top-1 after:left-1 after:bg-white after:w-6 after:h-6 after:rounded-full after:transition-all after:duration-300 peer-checked:after:translate-x-6"></div>
                </div>
            </label>

            {{-- Novos Clientes --}}
            <label class="flex items-center justify-between p-5 bg-white rounded-3xl border border-slate-100 shadow-sm cursor-pointer hover:border-primary/20 transition-all group">
                <div class="flex items-center gap-5">
                    <div class="w-14 h-14 bg-blue-50 text-primary rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-2xl fill-icon">person_add</span>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-800">Novos Clientes</h4>
                        <p class="text-xs text-slate-400 font-medium">Avisar quando um novo cliente se cadastrar em sua base.</p>
                    </div>
                </div>
                <div class="relative inline-flex items-center">
                    <input type="checkbox" wire:model.live="settings.customers_enabled" class="hidden peer">
                    <div class="w-14 h-8 bg-slate-200 peer-checked:bg-primary rounded-full transition-all duration-300 ease-in-out relative after:content-[''] after:absolute after:top-1 after:left-1 after:bg-white after:w-6 after:h-6 after:rounded-full after:transition-all after:duration-300 peer-checked:after:translate-x-6"></div>
                </div>
            </label>

            {{-- Saques Concluídos --}}
            <label class="flex items-center justify-between p-5 bg-white rounded-3xl border border-slate-100 shadow-sm cursor-pointer hover:border-primary/20 transition-all group">
                <div class="flex items-center gap-5">
                    <div class="w-14 h-14 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-2xl fill-icon">account_balance_wallet</span>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-800">Saques Concluídos</h4>
                        <p class="text-xs text-slate-400 font-medium">Receber confirmação quando o dinheiro cair em sua conta bancária.</p>
                    </div>
                </div>
                <div class="relative inline-flex items-center">
                    <input type="checkbox" wire:model.live="settings.withdrawals_enabled" class="hidden peer">
                    <div class="w-14 h-8 bg-slate-200 peer-checked:bg-primary rounded-full transition-all duration-300 ease-in-out relative after:content-[''] after:absolute after:top-1 after:left-1 after:bg-white after:w-6 after:h-6 after:rounded-full after:transition-all after:duration-300 peer-checked:after:translate-x-6"></div>
                </div>
            </label>

            {{-- Atualizações do Sistema --}}
            <label class="flex items-center justify-between p-5 bg-white rounded-3xl border border-slate-100 shadow-sm cursor-pointer hover:border-primary/20 transition-all group">
                <div class="flex items-center gap-5">
                    <div class="w-14 h-14 bg-slate-100 text-slate-500 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-2xl fill-icon">update</span>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-800">Atualizações do Sistema</h4>
                        <p class="text-xs text-slate-400 font-medium">Novas funcionalidades, manutenções e notícias importantes.</p>
                    </div>
                </div>
                <div class="relative inline-flex items-center">
                    <input type="checkbox" wire:model.live="settings.updates_enabled" class="hidden peer">
                    <div class="w-14 h-8 bg-slate-200 peer-checked:bg-primary rounded-full transition-all duration-300 ease-in-out relative after:content-[''] after:absolute after:top-1 after:left-1 after:bg-white after:w-6 after:h-6 after:rounded-full after:transition-all after:duration-300 peer-checked:after:translate-x-6"></div>
                </div>
            </label>
        </section>

        <div class="p-6 bg-blue-50/30 rounded-3xl border border-blue-100 flex items-center gap-4 animate-pulse uppercase tracking-widest text-primary italic font-bold" wire:loading wire:target="settings">
            <span class="material-symbols-outlined spin">sync</span>
            <span class="text-xs italic lowercase">Salvando alterações automaticamente...</span>
        </div>

        @if($isThrottled)
            <div class="p-6 bg-red-50 rounded-3xl border border-red-100 flex items-center gap-4 animate-in fade-in slide-in-from-top-4 duration-300">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-red-500 shadow-sm shrink-0">
                    <span class="material-symbols-outlined">timer</span>
                </div>
                <div>
                    <h5 class="text-sm font-bold text-red-800">Calma aí!</h5>
                    <p class="text-xs text-red-500 font-medium leading-relaxed">Você está fazendo alterações muito rápido. Por favor, aguarde alguns segundos antes de continuar.</p>
                </div>
            </div>
        @endif
    </div>

    <div class="lg:col-span-4 space-y-8">
        <div class="bg-blue-50/50 rounded-5xl p-8 border border-blue-100 shadow-sm">
            <div class="w-16 h-16 bg-white rounded-3xl flex items-center justify-center mb-6 shadow-md shadow-blue-500/5">
                <span class="material-symbols-outlined text-primary text-3xl fill-icon">mail</span>
            </div>
            <h3 class="text-xl font-bold mb-2 text-slate-800 leading-tight">Canal de Recebimento</h3>
            <p class="text-xs text-slate-400 font-medium mb-8">Escolha como as notificações acima serão entregues.</p>
            
            <div class="space-y-4">
                <label class="flex items-center justify-between p-4 bg-white rounded-3xl border border-slate-100 cursor-pointer hover:border-primary transition-all group">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary text-xl group-hover:scale-110 transition-transform">alternate_email</span>
                        <span class="text-xs font-bold text-slate-700">E-mail</span>
                    </div>
                    <input type="checkbox" wire:model.live="settings.channel_email" class="w-5 h-5 rounded-lg border-slate-300 bg-white text-primary focus:ring-primary shadow-sm transition-all cursor-pointer"/>
                </label>

                <label class="flex items-center justify-between p-4 bg-white rounded-3xl border border-slate-100 cursor-pointer hover:border-primary transition-all group">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary text-xl group-hover:scale-110 transition-transform">smartphone</span>
                        <span class="text-xs font-bold text-slate-700">Push App</span>
                    </div>
                    <input type="checkbox" wire:model.live="settings.channel_push" class="w-5 h-5 rounded-lg border-slate-300 bg-white text-primary focus:ring-primary shadow-sm transition-all cursor-pointer"/>
                </label>

                <label class="flex items-center justify-between p-4 bg-white rounded-3xl border border-slate-100 cursor-pointer hover:border-primary transition-all group">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary text-xl group-hover:scale-110 transition-transform">chat_bubble</span>
                        <span class="text-xs font-bold text-slate-700">WhatsApp</span>
                    </div>
                    <input type="checkbox" wire:model.live="settings.channel_whatsapp" class="w-5 h-5 rounded-lg border-slate-300 bg-white text-primary focus:ring-primary shadow-sm transition-all cursor-pointer"/>
                </label>
            </div>
        </div>

        @if(auth()->user()->business->plan?->slug !== 'finpay-plus')
            <div class="bg-linear-to-br from-primary to-blue-400 rounded-5xl p-8 text-white relative overflow-hidden group">
                <div class="relative z-10">
                    <div class="bg-white/20 text-white px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-wider w-fit mb-4">
                        Conta Premium
                    </div>
                    <h4 class="text-xl font-bold mb-2">FinPay Plus</h4>
                    <p class="text-xs text-white/80 mb-6 leading-relaxed">Alertas via SMS e WhatsApp ilimitados para assinantes Plus.</p>
                    <button class="bg-white/20 backdrop-blur-md text-white px-6 py-3 rounded-pill font-bold text-xs w-full hover:bg-white/30 transition-all">
                        Ver Detalhes
                    </button>
                </div>
                <span class="material-symbols-outlined absolute -bottom-6 -right-6 text-[10rem] text-white/10 rotate-12 group-hover:scale-110 transition-transform pointer-events-none">auto_awesome</span>
            </div>
        @endif
    </div>
</div>
