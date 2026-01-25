<div>
    <div class="w-full mx-auto flex overflow-hidden gap-4 px-4">
        <main
            class="flex-1 flex flex-col bg-white main-container-rounded shadow-[0_10px_40px_rgba(0,0,0,0.04)] overflow-hidden border border-slate-100">
            <header class="h-24 flex items-center justify-between px-12 border-b border-slate-50 shrink-0">
                <div class="flex items-center gap-3 text-sm font-medium">
                    <span class="material-symbols-outlined text-primary text-xl">link</span>
                    <span class="text-slate-900 font-bold">Links de Pagamento</span>
                </div>
                <div class="flex items-center gap-4">
                    <button
                        class="w-11 h-11 flex items-center justify-center text-slate-400 hover:bg-slate-50 rounded-full transition-all relative">
                        <span class="material-symbols-outlined text-xl">notifications</span>
                        <span
                            class="absolute top-3.5 right-3.5 w-1.5 h-1.5 bg-blue-600 rounded-full border border-white"></span>
                    </button>
                    <button
                        class="flex items-center gap-2 px-6 py-3 bg-primary text-white rounded-full font-bold text-xs hover:bg-blue-700 transition-all shadow-lg shadow-blue-500/20">
                        <span class="material-symbols-outlined text-sm">add</span>
                        Criar Link
                    </button>
                </div>
            </header>
            <div class="flex-1 overflow-y-auto p-12 custom-scrollbar">
                <div class="mb-10 flex items-center justify-between">
                    <div>
                        <h2 class="text-3xl font-extrabold tracking-tight text-slate-800">Meus Links</h2>
                        <p class="text-slate-400 mt-1 font-medium">Gerencie e compartilhe seus links de pagamento
                            rapidamente.</p>
                    </div>
                    <div class="flex gap-4">
                        <div class="relative">
                            <span
                                class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-xl">search</span>
                            <input
                                class="pl-12 pr-6 py-3 bg-slate-50 border-transparent focus:border-primary focus:ring-0 rounded-full text-sm w-64 transition-all"
                                placeholder="Buscar links..." type="text"/>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                    <div
                        class="bg-white border border-slate-100 rounded-4xl p-8 flex items-center gap-6 shadow-sm hover:shadow-md transition-all">
                        <div class="w-16 h-16 bg-blue-50 rounded-3xl flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined text-3xl fill-icon">account_balance_wallet</span>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Saldo Total</p>
                            <h3 class="text-2xl font-black text-slate-800">R$ 128.450,00</h3>
                            <p class="text-[10px] text-green-500 font-bold mt-1">+12% vs ontem</p>
                        </div>
                    </div>
                    <div
                        class="bg-white border border-slate-100 rounded-4xl p-8 flex items-center gap-6 shadow-sm hover:shadow-md transition-all">
                        <div class="w-16 h-16 bg-blue-50 rounded-3xl flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined text-3xl fill-icon">trending_up</span>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Vendas Hoje</p>
                            <h3 class="text-2xl font-black text-slate-800">R$ 12.840,12</h3>
                            <p class="text-[10px] text-blue-500 font-bold mt-1">156 transações</p>
                        </div>
                    </div>
                    <div
                        class="bg-white border border-slate-100 rounded-4xl p-8 flex items-center gap-6 shadow-sm hover:shadow-md transition-all">
                        <div class="w-16 h-16 bg-blue-50 rounded-3xl flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined text-3xl fill-icon">analytics</span>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Ticket Médio</p>
                            <h3 class="text-2xl font-black text-slate-800">R$ 184,50</h3>
                            <p class="text-[10px] text-slate-400 font-bold mt-1">Desempenho Estável</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-4">
                    <div
                        class="p-8 bg-white border border-slate-100 rounded-4xl flex items-center justify-between hover:border-blue-200 transition-all group">
                        <div class="flex items-center gap-6">
                            <div
                                class="w-16 h-16 bg-blue-50 rounded-3xl flex items-center justify-center text-primary group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-3xl">link</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 text-lg">Curso de Marketing Digital</h4>
                                <div class="flex items-center gap-3 mt-1">
                                    <span class="text-xs text-slate-400 font-medium">finpay.me/marketing-top</span>
                                    <span
                                        class="material-symbols-outlined text-sm text-slate-300 cursor-pointer hover:text-primary">content_copy</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-12">
                            <div class="text-right">
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Valor</p>
                                <p class="font-black text-slate-800 text-xl">R$ 497,00</p>
                            </div>
                            <div class="text-center w-24">
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Vendas</p>
                                <p class="font-bold text-slate-800">142</p>
                            </div>
                            <div>
                                <span
                                    class="px-4 py-1.5 bg-green-50 text-green-600 rounded-full text-[10px] font-black uppercase">Ativo</span>
                            </div>
                            <div class="flex gap-2">
                                <button
                                    class="w-10 h-10 flex items-center justify-center bg-slate-50 text-slate-400 rounded-full hover:bg-blue-50 hover:text-primary transition-all">
                                    <span class="material-symbols-outlined text-xl">edit</span>
                                </button>
                                <button
                                    class="w-10 h-10 flex items-center justify-center bg-slate-50 text-slate-400 rounded-full hover:bg-red-50 hover:text-red-500 transition-all">
                                    <span class="material-symbols-outlined text-xl">delete</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div
                        class="p-8 bg-white border border-slate-100 rounded-4xl flex items-center justify-between hover:border-blue-200 transition-all group">
                        <div class="flex items-center gap-6">
                            <div
                                class="w-16 h-16 bg-blue-50 rounded-3xl flex items-center justify-center text-primary group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-3xl">shopping_cart</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 text-lg">Mentoria Individual (1h)</h4>
                                <div class="flex items-center gap-3 mt-1">
                                    <span class="text-xs text-slate-400 font-medium">finpay.me/mentoria-joao</span>
                                    <span
                                        class="material-symbols-outlined text-sm text-slate-300 cursor-pointer hover:text-primary">content_copy</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-12">
                            <div class="text-right">
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Valor</p>
                                <p class="font-black text-slate-800 text-xl">R$ 1.200,00</p>
                            </div>
                            <div class="text-center w-24">
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Vendas</p>
                                <p class="font-bold text-slate-800">28</p>
                            </div>
                            <div>
                                <span
                                    class="px-4 py-1.5 bg-green-50 text-green-600 rounded-full text-[10px] font-black uppercase">Ativo</span>
                            </div>
                            <div class="flex gap-2">
                                <button
                                    class="w-10 h-10 flex items-center justify-center bg-slate-50 text-slate-400 rounded-full hover:bg-blue-50 hover:text-primary transition-all">
                                    <span class="material-symbols-outlined text-xl">edit</span>
                                </button>
                                <button
                                    class="w-10 h-10 flex items-center justify-center bg-slate-50 text-slate-400 rounded-full hover:bg-red-50 hover:text-red-500 transition-all">
                                    <span class="material-symbols-outlined text-xl">delete</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div
                        class="p-8 bg-white border border-slate-100 rounded-4xl flex items-center justify-between hover:border-blue-200 transition-all group opacity-75">
                        <div class="flex items-center gap-6">
                            <div
                                class="w-16 h-16 bg-slate-50 rounded-3xl flex items-center justify-center text-slate-400">
                                <span class="material-symbols-outlined text-3xl">pause_circle</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 text-lg">Workshop Presencial SP</h4>
                                <div class="flex items-center gap-3 mt-1">
                                    <span class="text-xs text-slate-400 font-medium">finpay.me/workshop-sp</span>
                                    <span
                                        class="material-symbols-outlined text-sm text-slate-300 cursor-pointer hover:text-primary">content_copy</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-12">
                            <div class="text-right">
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Valor</p>
                                <p class="font-black text-slate-800 text-xl">R$ 150,00</p>
                            </div>
                            <div class="text-center w-24">
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Vendas</p>
                                <p class="font-bold text-slate-800">5</p>
                            </div>
                            <div>
                                <span
                                    class="px-4 py-1.5 bg-slate-100 text-slate-500 rounded-full text-[10px] font-black uppercase">Pausado</span>
                            </div>
                            <div class="flex gap-2">
                                <button
                                    class="w-10 h-10 flex items-center justify-center bg-slate-50 text-slate-400 rounded-full hover:bg-blue-50 hover:text-primary transition-all">
                                    <span class="material-symbols-outlined text-xl">play_arrow</span>
                                </button>
                                <button
                                    class="w-10 h-10 flex items-center justify-center bg-slate-50 text-slate-400 rounded-full hover:bg-red-50 hover:text-red-500 transition-all">
                                    <span class="material-symbols-outlined text-xl">delete</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
