<div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
    <div class="lg:col-span-8 space-y-6">
        <section class="bg-slate-50 rounded-4xl p-8 border border-transparent hover:border-blue-100 transition-all space-y-6">
            <div class="flex items-center justify-between p-4 bg-white rounded-3xl border border-slate-100 shadow-sm">
                <div class="flex items-center gap-5">
                    <div class="w-12 h-12 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-2xl fill-icon">payments</span>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-800">Vendas Realizadas</h4>
                        <p class="text-xs text-slate-400 font-medium">Notificar instantaneamente sobre cada nova venda concluída.</p>
                    </div>
                </div>
                <button class="switch switch-on">
                    <span class="switch-handle switch-handle-on"></span>
                </button>
            </div>
            <div class="flex items-center justify-between p-4 bg-white rounded-3xl border border-slate-100 shadow-sm">
                <div class="flex items-center gap-5">
                    <div class="w-12 h-12 bg-blue-50 text-primary rounded-2xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-2xl fill-icon">person_add</span>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-800">Novos Clientes</h4>
                        <p class="text-xs text-slate-400 font-medium">Avisar quando um novo cliente se cadastrar em sua base.</p>
                    </div>
                </div>
                <button class="switch switch-on">
                    <span class="switch-handle switch-handle-on"></span>
                </button>
            </div>
            <div class="flex items-center justify-between p-4 bg-white rounded-3xl border border-slate-100 shadow-sm">
                <div class="flex items-center gap-5">
                    <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-2xl fill-icon">account_balance_wallet</span>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-800">Saques Concluídos</h4>
                        <p class="text-xs text-slate-400 font-medium">Receber confirmação quando o dinheiro cair em sua conta bancária.</p>
                    </div>
                </div>
                <button class="switch switch-on">
                    <span class="switch-handle switch-handle-on"></span>
                </button>
            </div>
            <div class="flex items-center justify-between p-4 bg-white rounded-3xl border border-slate-100 shadow-sm">
                <div class="flex items-center gap-5">
                    <div class="w-12 h-12 bg-slate-100 text-slate-500 rounded-2xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-2xl fill-icon">update</span>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-800">Atualizações do Sistema</h4>
                        <p class="text-xs text-slate-400 font-medium">Novas funcionalidades, manutenções e notícias importantes.</p>
                    </div>
                </div>
                <button class="switch switch-off">
                    <span class="switch-handle switch-handle-off"></span>
                </button>
            </div>
        </section>
        <div class="flex justify-end gap-4 pb-8">
            <button class="px-8 py-4 text-sm font-bold text-slate-500 hover:bg-slate-50 rounded-pill transition-all">Cancelar</button>
            <button class="px-10 py-4 bg-primary text-white rounded-pill text-sm font-bold shadow-lg shadow-blue-500/20 hover:scale-[1.02] transition-all">Salvar Preferências</button>
        </div>
    </div>
    <div class="lg:col-span-4 space-y-8">
        <div class="bg-blue-50/50 rounded-5xl p-8 border border-blue-100 shadow-sm">
            <div class="w-16 h-16 bg-white rounded-3xl flex items-center justify-center mb-6 shadow-md shadow-blue-500/5">
                <span class="material-symbols-outlined text-primary text-3xl fill-icon">mail</span>
            </div>
            <h3 class="text-xl font-bold mb-2 text-slate-800 leading-tight">Canal de Recebimento</h3>
            <p class="text-xs text-slate-400 font-medium mb-8">Escolha como as notificações acima serão entregues.</p>
            <div class="space-y-4">
                <label class="flex items-center justify-between p-4 bg-white rounded-3xl border border-slate-100 cursor-pointer hover:border-primary/30 transition-all">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary text-xl">alternate_email</span>
                        <span class="text-xs font-bold text-slate-700">E-mail</span>
                    </div>
                    <input checked="" class="w-5 h-5 rounded-lg border-slate-200 text-primary focus:ring-primary" type="checkbox"/>
                </label>
                <label class="flex items-center justify-between p-4 bg-white rounded-3xl border border-slate-100 cursor-pointer hover:border-primary/30 transition-all">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary text-xl">smartphone</span>
                        <span class="text-xs font-bold text-slate-700">Push App</span>
                    </div>
                    <input checked="" class="w-5 h-5 rounded-lg border-slate-200 text-primary focus:ring-primary" type="checkbox"/>
                </label>
                <label class="flex items-center justify-between p-4 bg-white rounded-3xl border border-slate-100 cursor-pointer hover:border-primary/30 transition-all">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary text-xl">chat_bubble</span>
                        <span class="text-xs font-bold text-slate-700">WhatsApp</span>
                    </div>
                    <input class="w-5 h-5 rounded-lg border-slate-200 text-primary focus:ring-primary" type="checkbox"/>
                </label>
            </div>
        </div>
        <div class="bg-gradient-to-br from-primary to-blue-400 rounded-5xl p-8 text-white relative overflow-hidden group">
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
        <div class="px-6 text-center">
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">© 2024 FinPay Blue</p>
        </div>
    </div>
</div>
