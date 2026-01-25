<div>
    <div class="w-full mx-auto overflow-hidden gap-4 px-4">
        <main class="flex-1 flex flex-col bg-white main-container-rounded shadow-[0_10px_40px_rgba(0,0,0,0.04)] overflow-hidden border border-slate-100">
            <header class="h-24 flex items-center justify-between px-12 border-b border-slate-50 shrink-0">
                <div class="flex items-center gap-3 text-sm font-medium">
                    <span class="material-symbols-outlined text-primary text-xl">home</span>
                    <span class="text-slate-400">Dashboard</span>
                    <span class="material-symbols-outlined text-slate-300 text-sm">chevron_right</span>
                    <span class="text-slate-900 font-bold">Cupons de Desconto</span>
                </div>
                <div class="flex items-center gap-4">
                    <button class="flex items-center gap-2 px-6 py-2.5 bg-primary text-white rounded-full font-bold text-xs hover:opacity-90 transition-all shadow-lg shadow-blue-500/20">
                        <span class="material-symbols-outlined text-sm">add</span>
                        Criar Novo Cupom
                    </button>
                </div>
            </header>
            <div class="flex-1 overflow-y-auto p-12 custom-scrollbar">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                    <div class="bg-white border border-slate-100 rounded-4xl p-8 flex items-center gap-6 shadow-sm">
                        <div class="w-16 h-16 bg-blue-50 rounded-[2rem] flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined text-3xl fill-icon">sell</span>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-1">Cupons Ativos</p>
                            <h3 class="text-3xl font-black text-slate-800">12</h3>
                        </div>
                    </div>
                    <div class="bg-white border border-slate-100 rounded-4xl p-8 flex items-center gap-6 shadow-sm">
                        <div class="w-16 h-16 bg-blue-50 rounded-[2rem] flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined text-3xl fill-icon">confirmation_number</span>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-1">Total de Usos</p>
                            <h3 class="text-3xl font-black text-slate-800">842</h3>
                        </div>
                    </div>
                    <div class="bg-white border border-slate-100 rounded-4xl p-8 flex items-center gap-6 shadow-sm">
                        <div class="w-16 h-16 bg-blue-50 rounded-[2rem] flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined text-3xl fill-icon">savings</span>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-1">Economia Gerada</p>
                            <h3 class="text-3xl font-black text-slate-800">R$ 4.250</h3>
                        </div>
                    </div>
                </div>
                <div class="mb-8 flex items-center justify-between">
                    <div>
                        <h2 class="text-3xl font-extrabold tracking-tight text-slate-800">Seus Cupons</h2>
                        <p class="text-slate-400 mt-1 font-medium">Gerencie suas campanhas de desconto de forma simples.</p>
                    </div>
                    <div class="flex gap-3">
                        <div class="relative">
                            <input class="pl-12 pr-6 py-3 bg-slate-50 border-transparent rounded-pill text-sm focus:ring-primary focus:border-primary w-64 transition-all" placeholder="Buscar cupom..." type="text"/>
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                        </div>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="coupon-card flex items-center justify-between">
                        <div class="flex items-center gap-6 flex-1">
                            <div class="w-14 h-14 bg-blue-600 rounded-3xl flex items-center justify-center text-white shadow-lg shadow-blue-500/20">
                                <span class="material-symbols-outlined text-2xl font-bold">percent</span>
                            </div>
                            <div class="min-w-0">
                                <h4 class="font-bold text-lg text-slate-800">Black Friday Early</h4>
                                <div class="flex items-center gap-2 mt-0.5">
                                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Código:</span>
                                    <span class="px-2 py-0.5 bg-blue-50 text-primary text-[11px] font-black rounded-md border border-blue-100">BLACK2024</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex-1 flex justify-center">
                            <div class="text-center">
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.1em] mb-1">Desconto</p>
                                <p class="text-xl font-black text-blue-600">15% OFF</p>
                            </div>
                        </div>
                        <div class="flex-1 flex justify-center">
                            <div class="text-center">
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.1em] mb-1">Expira em</p>
                                <p class="text-sm font-bold text-slate-700">30 Nov, 2024</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-8">
                            <div class="flex flex-col items-end">
<span class="px-4 py-1.5 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-bold uppercase tracking-wider flex items-center gap-1.5">
<span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                Ativo
                            </span>
                                <p class="text-[10px] text-slate-400 mt-1 font-bold">128 usos</p>
                            </div>
                            <div class="flex gap-2">
                                <button class="w-10 h-10 flex items-center justify-center rounded-2xl bg-slate-50 text-slate-400 hover:text-primary hover:bg-blue-50 transition-all">
                                    <span class="material-symbols-outlined text-xl">edit</span>
                                </button>
                                <button class="w-10 h-10 flex items-center justify-center rounded-2xl bg-slate-50 text-slate-400 hover:text-red-500 hover:bg-red-50 transition-all">
                                    <span class="material-symbols-outlined text-xl">delete</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="coupon-card flex items-center justify-between">
                        <div class="flex items-center gap-6 flex-1">
                            <div class="w-14 h-14 bg-slate-100 rounded-3xl flex items-center justify-center text-slate-400">
                                <span class="material-symbols-outlined text-2xl font-bold">sell</span>
                            </div>
                            <div class="min-w-0">
                                <h4 class="font-bold text-lg text-slate-800">Primeira Compra</h4>
                                <div class="flex items-center gap-2 mt-0.5">
                                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Código:</span>
                                    <span class="px-2 py-0.5 bg-slate-50 text-slate-600 text-[11px] font-black rounded-md border border-slate-200">WELCOME20</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex-1 flex justify-center">
                            <div class="text-center">
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.1em] mb-1">Desconto</p>
                                <p class="text-xl font-black text-slate-800">R$ 20,00</p>
                            </div>
                        </div>
                        <div class="flex-1 flex justify-center">
                            <div class="text-center">
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.1em] mb-1">Expira em</p>
                                <p class="text-sm font-bold text-slate-700">Sem expiração</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-8">
                            <div class="flex flex-col items-end">
<span class="px-4 py-1.5 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-bold uppercase tracking-wider flex items-center gap-1.5">
<span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                Ativo
                            </span>
                                <p class="text-[10px] text-slate-400 mt-1 font-bold">564 usos</p>
                            </div>
                            <div class="flex gap-2">
                                <button class="w-10 h-10 flex items-center justify-center rounded-2xl bg-slate-50 text-slate-400 hover:text-primary hover:bg-blue-50 transition-all">
                                    <span class="material-symbols-outlined text-xl">edit</span>
                                </button>
                                <button class="w-10 h-10 flex items-center justify-center rounded-2xl bg-slate-50 text-slate-400 hover:text-red-500 hover:bg-red-50 transition-all">
                                    <span class="material-symbols-outlined text-xl">delete</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="coupon-card flex items-center justify-between opacity-75">
                        <div class="flex items-center gap-6 flex-1">
                            <div class="w-14 h-14 bg-slate-100 rounded-3xl flex items-center justify-center text-slate-300">
                                <span class="material-symbols-outlined text-2xl font-bold">timer_off</span>
                            </div>
                            <div class="min-w-0">
                                <h4 class="font-bold text-lg text-slate-500">Natal Antecipado</h4>
                                <div class="flex items-center gap-2 mt-0.5">
                                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Código:</span>
                                    <span class="px-2 py-0.5 bg-slate-50 text-slate-400 text-[11px] font-black rounded-md border border-slate-200">XMAS24</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex-1 flex justify-center">
                            <div class="text-center">
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.1em] mb-1">Desconto</p>
                                <p class="text-xl font-black text-slate-400">10% OFF</p>
                            </div>
                        </div>
                        <div class="flex-1 flex justify-center">
                            <div class="text-center">
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.1em] mb-1">Expira em</p>
                                <p class="text-sm font-bold text-slate-400">25 Dez, 2024</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-8">
                            <div class="flex flex-col items-end">
<span class="px-4 py-1.5 bg-slate-100 text-slate-500 rounded-full text-[10px] font-bold uppercase tracking-wider flex items-center gap-1.5">
<span class="w-1.5 h-1.5 bg-slate-400 rounded-full"></span>
                                Pausado
                            </span>
                                <p class="text-[10px] text-slate-400 mt-1 font-bold">15 usos</p>
                            </div>
                            <div class="flex gap-2">
                                <button class="w-10 h-10 flex items-center justify-center rounded-2xl bg-slate-50 text-slate-400 hover:text-primary hover:bg-blue-50 transition-all">
                                    <span class="material-symbols-outlined text-xl">play_arrow</span>
                                </button>
                                <button class="w-10 h-10 flex items-center justify-center rounded-2xl bg-slate-50 text-slate-400 hover:text-red-500 hover:bg-red-50 transition-all">
                                    <span class="material-symbols-outlined text-xl">delete</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-12 bg-gradient-to-r from-blue-600 to-blue-400 rounded-5xl p-10 text-white relative overflow-hidden flex items-center justify-between">
                    <div class="relative z-10 max-w-lg">
                        <span class="px-3 py-1 bg-white/20 rounded-full text-[10px] font-black uppercase tracking-widest mb-4 inline-block">Dica de especialista</span>
                        <h3 class="text-3xl font-bold mb-4">Aumente suas vendas em até 30%</h3>
                        <p class="text-white/80 leading-relaxed mb-6">Oferecer cupons por tempo limitado cria senso de urgência e melhora a conversão do seu checkout.</p>
                        <button class="bg-white text-primary px-8 py-3 rounded-pill font-extrabold text-sm hover:scale-105 transition-all shadow-xl">
                            Aprender Estratégias
                        </button>
                    </div>
                    <div class="hidden lg:block">
                        <span class="material-symbols-outlined text-[10rem] text-white/10 rotate-12">local_offer</span>
                    </div>
                </div>
            </div>
        </main>
    </div>

</div>
