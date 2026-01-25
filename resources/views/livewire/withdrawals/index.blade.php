<div>
    <div class="w-full mx-auto flex overflow-hidden gap-4 px-4">
        <main class="flex-1 flex flex-col bg-white main-container-rounded shadow-[0_10px_40px_rgba(0,0,0,0.04)] overflow-hidden border border-slate-100">
            <header class="h-24 flex items-center justify-between px-12 border-b border-slate-50 shrink-0">
                <div class="flex items-center gap-3 text-sm font-medium">
                    <span class="material-symbols-outlined text-primary text-xl">account_balance_wallet</span>
                    <span class="text-slate-900 font-bold">Gestão de Saques</span>
                </div>
                <div class="flex items-center gap-4">
                    <button class="w-11 h-11 flex items-center justify-center text-slate-400 hover:bg-slate-50 rounded-full transition-all relative">
                        <span class="material-symbols-outlined text-xl">notifications</span>
                        <span class="absolute top-3.5 right-3.5 w-1.5 h-1.5 bg-blue-600 rounded-full border border-white"></span>
                    </button>
                    <button class="flex items-center gap-2 px-4 py-2 bg-blue-50 text-primary rounded-full font-bold text-xs hover:bg-blue-100 transition-all">
                        <span class="material-symbols-outlined text-sm fill-icon">verified_user</span>
                        Conta Verificada
                    </button>
                </div>
            </header>
            <div class="flex-1 overflow-y-auto p-12 custom-scrollbar">
                <div class="mb-12">
                    <div class="flex justify-between items-end mb-8">
                        <div>
                            <h2 class="text-3xl font-extrabold tracking-tight text-slate-800">Saques</h2>
                            <p class="text-slate-400 mt-1 font-medium">Gerencie seus recebimentos e transferências.</p>
                        </div>
                        <button class="bg-primary text-white px-8 py-4 rounded-pill font-bold text-sm shadow-lg shadow-blue-600/20 hover:scale-105 transition-all flex items-center gap-2">
                            <span class="material-symbols-outlined text-lg">add</span>
                            Novo Saque
                        </button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="md:col-span-2 bg-primary rounded-4xl p-10 text-white shadow-2xl shadow-blue-600/10 flex flex-col justify-between relative overflow-hidden group">
                            <div class="relative z-10">
                                <div class="flex items-center gap-3 mb-8">
                                    <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center">
                                        <span class="material-symbols-outlined text-white fill-icon">payments</span>
                                    </div>
                                    <p class="text-xs font-bold uppercase tracking-[0.15em] opacity-80">Disponível para Saque</p>
                                </div>
                                <div class="flex items-baseline gap-2">
                                    <span class="text-2xl font-bold opacity-60">R$</span>
                                    <h3 class="text-6xl font-black tracking-tight">128.450,00</h3>
                                </div>
                            </div>
                            <div class="relative z-10 mt-10 flex gap-4">
                                <div class="px-5 py-3 bg-white/10 rounded-3xl backdrop-blur-md">
                                    <p class="text-[10px] uppercase font-bold opacity-60 mb-1">Pendente</p>
                                    <p class="font-bold">R$ 12.400,00</p>
                                </div>
                                <div class="px-5 py-3 bg-white/10 rounded-3xl backdrop-blur-md">
                                    <p class="text-[10px] uppercase font-bold opacity-60 mb-1">Próximo Lote</p>
                                    <p class="font-bold">Amanhã, 09:00</p>
                                </div>
                            </div>
                            <span class="material-symbols-outlined absolute -bottom-10 -right-10 text-[18rem] text-white/5 rotate-12 pointer-events-none">account_balance_wallet</span>
                        </div>
                        <div class="bg-white rounded-4xl p-10 border border-slate-100 shadow-xl shadow-slate-200/40 flex flex-col justify-center text-center">
                            <div class="w-16 h-16 bg-blue-50 text-primary rounded-3xl flex items-center justify-center mx-auto mb-6">
                                <span class="material-symbols-outlined text-3xl">account_balance</span>
                            </div>
                            <h4 class="text-lg font-bold text-slate-800 mb-2">Conta Principal</h4>
                            <p class="text-sm text-slate-400 font-medium mb-6 leading-relaxed">Banco do Brasil<br/>Ag: 1234 • C/C: 56789-0</p>
                            <button class="text-primary font-bold text-xs hover:bg-blue-50 py-3 rounded-full border border-blue-100 transition-all">Alterar Conta</button>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col lg:flex-row gap-12">
                    <div class="flex-1 space-y-6">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="text-xl font-bold text-slate-800">Histórico de Saques</h4>
                            <div class="flex gap-2">
                                <button class="p-2 bg-slate-100 rounded-xl hover:bg-slate-200 transition-colors">
                                    <span class="material-symbols-outlined text-slate-500 text-lg">filter_list</span>
                                </button>
                                <button class="p-2 bg-slate-100 rounded-xl hover:bg-slate-200 transition-colors">
                                    <span class="material-symbols-outlined text-slate-500 text-lg">download</span>
                                </button>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="p-6 bg-slate-50 rounded-4xl flex items-center justify-between hover:bg-blue-50/50 transition-all border border-transparent hover:border-blue-100 group">
                                <div class="flex items-center gap-5">
                                    <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-blue-600 shadow-sm group-hover:scale-105 transition-transform">
                                        <span class="material-symbols-outlined fill-icon text-2xl">check_circle</span>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800">Saque via TED</p>
                                        <p class="text-xs text-slate-400 font-medium">Finalizado em 24 Out, 2023 • 14:20</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-black text-slate-800">R$ 15.000,00</p>
                                    <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-100 text-green-600 rounded-full text-[10px] font-bold uppercase mt-1">
                                        <span class="w-1 h-1 bg-green-600 rounded-full"></span>
                                        Sucesso
                                    </div>
                                </div>
                            </div>
                            <div class="p-6 bg-slate-50 rounded-4xl flex items-center justify-between hover:bg-blue-50/50 transition-all border border-transparent hover:border-blue-100 group">
                                <div class="flex items-center gap-5">
                                    <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-blue-400 shadow-sm group-hover:scale-105 transition-transform">
                                        <span class="material-symbols-outlined text-2xl">history</span>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800">Saque via PIX</p>
                                        <p class="text-xs text-slate-400 font-medium">Solicitado em 25 Out, 2023 • 09:15</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-black text-slate-800">R$ 2.450,00</p>
                                    <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-[10px] font-bold uppercase mt-1">
                                        <span class="w-1 h-1 bg-blue-600 rounded-full"></span>
                                        Processando
                                    </div>
                                </div>
                            </div>
                            <div class="p-6 bg-slate-50 rounded-4xl flex items-center justify-between hover:bg-blue-50/50 transition-all border border-transparent hover:border-blue-100 group">
                                <div class="flex items-center gap-5">
                                    <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-blue-600 shadow-sm group-hover:scale-105 transition-transform">
                                        <span class="material-symbols-outlined fill-icon text-2xl">check_circle</span>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800">Saque via TED</p>
                                        <p class="text-xs text-slate-400 font-medium">Finalizado em 20 Out, 2023 • 17:45</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-black text-slate-800">R$ 48.000,00</p>
                                    <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-100 text-green-600 rounded-full text-[10px] font-bold uppercase mt-1">
                                        <span class="w-1 h-1 bg-green-600 rounded-full"></span>
                                        Sucesso
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="w-full py-4 text-slate-400 font-bold text-sm hover:text-primary transition-colors flex items-center justify-center gap-2">
                            Carregar mais registros
                            <span class="material-symbols-outlined text-lg">expand_more</span>
                        </button>
                    </div>
                    <div class="w-full lg:w-80 flex flex-col gap-8">
                        <div class="bg-blue-50/50 rounded-5xl p-8 border border-blue-100 text-center shadow-sm">
                            <div class="w-16 h-16 bg-white rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-md shadow-blue-500/5">
                                <span class="material-symbols-outlined text-primary text-3xl fill-icon">support_agent</span>
                            </div>
                            <h3 class="text-xl font-bold mb-8 text-slate-800 leading-tight">Dúvidas sobre o saque?</h3>
                            <div class="space-y-3">
                                <button class="w-full py-4 bg-white rounded-pill text-xs font-bold shadow-sm border border-slate-100 hover:border-primary hover:text-primary transition-all flex items-center px-6 gap-4 group">
                                    <span class="material-symbols-outlined text-primary text-lg group-hover:scale-110 transition-transform">info</span>
                                    <span>Prazos de Saque</span>
                                </button>
                                <button class="w-full py-4 bg-white rounded-pill text-xs font-bold shadow-sm border border-slate-100 hover:border-primary hover:text-primary transition-all flex items-center px-6 gap-4 group">
                                    <span class="material-symbols-outlined text-primary text-lg group-hover:scale-110 transition-transform">chat</span>
                                    <span>Suporte Online</span>
                                </button>
                            </div>
                        </div>
                        <div class="bg-gradient-to-br from-primary to-blue-400 rounded-5xl p-8 text-white relative overflow-hidden group">
                            <div class="relative z-10">
                                <div class="bg-white/20 text-white px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-wider w-fit mb-4">
                                    Pro
                                </div>
                                <h4 class="text-xl font-bold mb-2">Saque Instantâneo</h4>
                                <p class="text-xs text-white/80 mb-6 leading-relaxed">Ative o PIX 24/7 e receba seus valores em até 10 segundos, mesmo em feriados.</p>
                                <button class="bg-white text-primary px-6 py-3 rounded-pill font-bold text-xs w-full shadow-lg hover:scale-105 transition-all">
                                    Ativar Agora
                                </button>
                            </div>
                            <span class="material-symbols-outlined absolute -bottom-6 -right-6 text-[10rem] text-white/10 rotate-12 group-hover:scale-110 transition-transform pointer-events-none">bolt</span>
                        </div>
                        <div class="px-6 text-center">
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">© 2024 FinPay Blue</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
