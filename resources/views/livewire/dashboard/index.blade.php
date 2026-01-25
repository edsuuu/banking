<div>
    <div class="w-full mx-auto flex overflow-hidden gap-4 px-4">
        <main
            class="flex-1 flex flex-col bg-white main-container-rounded shadow-[0_10px_40px_rgba(0,0,0,0.04)] overflow-hidden border border-slate-100">
            <header class="h-24 flex items-center justify-between px-12 border-b border-slate-50 shrink-0">
                <div class="flex items-center gap-3 text-sm font-medium">
                    <span class="material-symbols-outlined text-primary text-xl">home</span>
                    <span class="text-slate-900 font-bold">Dashboard Geral</span>
                </div>
                <div class="flex items-center gap-4">
                    <button
                        class="w-11 h-11 flex items-center justify-center text-slate-400 hover:bg-slate-50 rounded-full transition-all relative">
                        <span class="material-symbols-outlined text-xl">notifications</span>
                        <span
                            class="absolute top-3.5 right-3.5 w-1.5 h-1.5 bg-blue-600 rounded-full border border-white"></span>
                    </button>
                    <button
                        class="flex items-center gap-2 px-4 py-2 bg-blue-50 text-primary rounded-full font-bold text-xs hover:bg-blue-100 transition-all">
                        <span class="material-symbols-outlined text-sm fill-icon">verified_user</span>
                        Conta Verificada
                    </button>
                </div>
            </header>
            <div class="flex-1 overflow-y-auto p-12 custom-scrollbar">
                <div class="mb-10">
                    <h2 class="text-3xl font-extrabold tracking-tight text-slate-800">Bem-vindo, João</h2>
                    <p class="text-slate-400 mt-1 font-medium">Veja como está o desempenho do seu negócio hoje.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                    <div
                        class="bg-primary rounded-4xl p-8 text-white shadow-xl shadow-blue-600/10 flex flex-col justify-between group hover:shadow-blue-600/20 transition-all">
                        <div class="flex justify-between items-start mb-6">
                            <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center">
                                <span class="material-symbols-outlined text-white">account_balance_wallet</span>
                            </div>
                            <div class="px-3 py-1 bg-white/20 rounded-full text-[10px] font-bold uppercase tracking-wider">
                                +12% vs ontem
                            </div>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-[0.1em] opacity-80 mb-1">Saldo Disponível</p>
                            <h3 class="text-3xl font-black">R$ 128.450,00</h3>
                        </div>
                    </div>
                    <div
                        class="bg-blue-500 rounded-4xl p-8 text-white shadow-xl shadow-blue-500/10 flex flex-col justify-between group hover:shadow-blue-500/20 transition-all">
                        <div class="flex justify-between items-start mb-6">
                            <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center">
                                <span class="material-symbols-outlined text-white">trending_up</span>
                            </div>
                            <div class="px-3 py-1 bg-white/20 rounded-full text-[10px] font-bold uppercase tracking-wider">
                                156 transações
                            </div>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-[0.1em] opacity-80 mb-1">Vendas Hoje</p>
                            <h3 class="text-3xl font-black">R$ 12.840,12</h3>
                        </div>
                    </div>
                    <div
                        class="bg-blue-400 rounded-4xl p-8 text-white shadow-xl shadow-blue-400/10 flex flex-col justify-between group hover:shadow-blue-400/20 transition-all">
                        <div class="flex justify-between items-start mb-6">
                            <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center">
                                <span class="material-symbols-outlined text-white">analytics</span>
                            </div>
                            <div class="px-3 py-1 bg-white/20 rounded-full text-[10px] font-bold uppercase tracking-wider">
                                Estável
                            </div>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-[0.1em] opacity-80 mb-1">Ticket Médio</p>
                            <h3 class="text-3xl font-black">R$ 184,50</h3>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col lg:flex-row gap-12">
                    <div class="flex-1 space-y-6">
                        <div class="flex items-center justify-between">
                            <h4 class="text-xl font-bold text-slate-800">Transações Recentes</h4>
                            <button class="text-primary font-bold text-sm hover:underline">Ver todas</button>
                        </div>
                        <div class="space-y-3">
                            <div
                                class="p-6 bg-slate-50 rounded-4xl flex items-center justify-between hover:bg-blue-50/50 transition-all border border-transparent hover:border-blue-100">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-blue-600 shadow-sm">
                                        <span class="material-symbols-outlined fill-icon">add_circle</span>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800">Venda #9482</p>
                                        <p class="text-xs text-slate-400 font-medium">Hoje às 14:35 • Cartão</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-black text-blue-600">+ R$ 450,00</p>
                                    <p class="text-[10px] uppercase font-bold text-slate-400">Aprovado</p>
                                </div>
                            </div>
                            <div
                                class="p-6 bg-slate-50 rounded-4xl flex items-center justify-between hover:bg-blue-50/50 transition-all border border-transparent hover:border-blue-100">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-blue-600 shadow-sm">
                                        <span class="material-symbols-outlined fill-icon">photos</span>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800">Pagamento Pix</p>
                                        <p class="text-xs text-slate-400 font-medium">Hoje às 12:20 • Link</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-black text-blue-600">+ R$ 89,90</p>
                                    <p class="text-[10px] uppercase font-bold text-slate-400">Aprovado</p>
                                </div>
                            </div>
                            <div
                                class="p-6 bg-slate-50 rounded-4xl flex items-center justify-between hover:bg-blue-50/50 transition-all border border-transparent hover:border-blue-100">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-slate-400 shadow-sm">
                                        <span class="material-symbols-outlined">outbound</span>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800">Saque Realizado</p>
                                        <p class="text-xs text-slate-400 font-medium">Ontem às 18:00 • Banco</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-black text-slate-800">- R$ 2.500,00</p>
                                    <p class="text-[10px] uppercase font-bold text-slate-400">Processado</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full lg:w-80 flex flex-col gap-8">
                        <div class="bg-blue-50/50 rounded-5xl p-8 border border-blue-100 text-center shadow-sm">
                            <div
                                class="w-16 h-16 bg-white rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-md shadow-blue-500/5">
                                <span class="material-symbols-outlined text-primary text-3xl fill-icon">support_agent</span>
                            </div>
                            <h3 class="text-xl font-bold mb-8 text-slate-800 leading-tight">Como posso te ajudar hoje?</h3>
                            <div class="space-y-3">
                                <button
                                    class="w-full py-4 bg-white rounded-pill text-xs font-bold shadow-sm border border-slate-100 hover:border-primary hover:text-primary transition-all flex items-center px-6 gap-4 group">
                                <span
                                    class="material-symbols-outlined text-primary text-lg group-hover:scale-110 transition-transform">menu_book</span>
                                    <span>Base de Conhecimento</span>
                                </button>
                                <button
                                    class="w-full py-4 bg-white rounded-pill text-xs font-bold shadow-sm border border-slate-100 hover:border-primary hover:text-primary transition-all flex items-center px-6 gap-4 group">
                                <span
                                    class="material-symbols-outlined text-primary text-lg group-hover:scale-110 transition-transform">chat</span>
                                    <span>Suporte via Chat</span>
                                </button>
                                <button
                                    class="w-full py-4 bg-white rounded-pill text-xs font-bold shadow-sm border border-slate-100 hover:border-primary hover:text-primary transition-all flex items-center px-6 gap-4 group">
                                <span
                                    class="material-symbols-outlined text-primary text-lg group-hover:scale-110 transition-transform">live_help</span>
                                    <span>FAQs Frequentes</span>
                                </button>
                            </div>
                        </div>
                        <div
                            class="bg-gradient-to-br from-primary to-blue-400 rounded-5xl p-8 text-white relative overflow-hidden group">
                            <div class="relative z-10">
                                <div
                                    class="bg-white/20 text-white px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-wider w-fit mb-4">
                                    Oportunidade
                                </div>
                                <h4 class="text-xl font-bold mb-2">Upgrade FinPay Plus</h4>
                                <p class="text-xs text-white/80 mb-6 leading-relaxed">Taxas de antecipação reduzidas para
                                    1.5% e suporte prioritário 24h.</p>
                                <button
                                    class="bg-white text-primary px-6 py-3 rounded-pill font-bold text-xs w-full shadow-lg hover:scale-105 transition-all">
                                    Quero Upgrade
                                </button>
                            </div>
                            <span
                                class="material-symbols-outlined absolute -bottom-6 -right-6 text-[10rem] text-white/10 rotate-12 group-hover:scale-110 transition-transform pointer-events-none">auto_awesome</span>
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
