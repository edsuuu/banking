<div>
    <div class="w-full mx-auto flex  overflow-hidden gap-4 px-4">
        <main class="flex-1 flex flex-col bg-white main-container-rounded shadow-[0_10px_40px_rgba(0,0,0,0.04)] overflow-hidden border border-slate-100">
            <header class="h-24 flex items-center justify-between px-12 border-b border-slate-50 shrink-0">
                <div class="flex items-center gap-2 text-sm font-medium">
                    <span class="material-symbols-outlined text-slate-400 text-lg">home</span>
                    <span class="text-slate-400">Home</span>
                    <span class="text-slate-300">/</span>
                    <span class="text-primary font-bold">Produtos</span>
                </div>
                <div class="flex items-center gap-4">
                    <button class="w-11 h-11 flex items-center justify-center text-slate-400 hover:bg-slate-50 rounded-full transition-all relative">
                        <span class="material-symbols-outlined text-xl">notifications</span>
                        <span class="absolute top-3.5 right-3.5 w-1.5 h-1.5 bg-blue-600 rounded-full border border-white"></span>
                    </button>
                    <div class="h-8 w-px bg-slate-100"></div>
                    <button class="flex items-center gap-2 px-4 py-2 bg-blue-50 text-primary rounded-full font-bold text-xs hover:bg-blue-100 transition-all">
                        <span class="material-symbols-outlined text-sm fill-icon">verified_user</span>
                        Conta Verificada
                    </button>
                </div>
            </header>
            <div class="flex-1 overflow-y-auto p-12 custom-scrollbar flex justify-center">
                <div class="w-full max-w-[1280px]">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
                        <div>
                            <h2 class="text-3xl font-extrabold tracking-tight text-slate-800">Meus Produtos</h2>
                            <p class="text-slate-400 mt-1 font-medium">Gerencie suas ofertas e acompanhe o desempenho individual.</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg">search</span>
                                <input class="pl-11 pr-6 py-3 bg-slate-50 border-transparent focus:border-primary focus:ring-0 rounded-full w-64 text-sm font-medium placeholder:text-slate-400 transition-all" placeholder="Buscar produto..." type="text"/>
                            </div>
                            <button class="flex items-center gap-2 px-6 py-3 gradient-blue text-white rounded-full font-bold text-sm shadow-lg shadow-blue-500/20 hover:scale-105 transition-all">
                                <span class="material-symbols-outlined text-lg">add</span>
                                Novo Produto
                            </button>
                        </div>
                    </div>
                    <div class="bg-white">
                        <table class="w-full table-rounded">
                            <thead>
                            <tr class="text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                <th class="px-6 pb-4">Produto</th>
                                <th class="px-6 pb-4">Preço</th>
                                <th class="px-6 pb-4">Vendas</th>
                                <th class="px-6 pb-4">Receita</th>
                                <th class="px-6 pb-4">Status</th>
                                <th class="px-6 pb-4 text-center">Ações</th>
                            </tr>
                            </thead>
                            <tbody class="space-y-4">
                            <tr class="group hover:bg-slate-50 transition-all">
                                <td class="px-6 py-5 bg-slate-50 group-hover:bg-blue-50/50 rounded-l-4xl border-y border-l border-transparent group-hover:border-blue-100">
                                    <div class="flex items-center gap-4">
                                        <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-primary shadow-sm border border-slate-100 overflow-hidden">
                                            <span class="material-symbols-outlined text-2xl fill-icon">movie</span>
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800">Curso: Design para Devs</p>
                                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tight">Infoproduto</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 bg-slate-50 group-hover:bg-blue-50/50 border-y border-transparent group-hover:border-blue-100">
                                    <p class="font-black text-slate-800">R$ 497,00</p>
                                </td>
                                <td class="px-6 py-5 bg-slate-50 group-hover:bg-blue-50/50 border-y border-transparent group-hover:border-blue-100">
                                    <p class="font-bold text-slate-600">1.240</p>
                                </td>
                                <td class="px-6 py-5 bg-slate-50 group-hover:bg-blue-50/50 border-y border-transparent group-hover:border-blue-100">
                                    <p class="font-black text-blue-600">R$ 616.280</p>
                                </td>
                                <td class="px-6 py-5 bg-slate-50 group-hover:bg-blue-50/50 border-y border-transparent group-hover:border-blue-100">
                                    <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-[10px] font-black uppercase">Ativo</span>
                                </td>
                                <td class="px-6 py-5 bg-slate-50 group-hover:bg-blue-50/50 rounded-r-4xl border-y border-r border-transparent group-hover:border-blue-100 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button class="w-9 h-9 flex items-center justify-center text-slate-400 hover:text-primary hover:bg-white rounded-full transition-all border border-transparent hover:border-slate-200">
                                            <span class="material-symbols-outlined text-xl">edit</span>
                                        </button>
                                        <button class="w-9 h-9 flex items-center justify-center text-slate-400 hover:text-primary hover:bg-white rounded-full transition-all border border-transparent hover:border-slate-200">
                                            <span class="material-symbols-outlined text-xl">link</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="group hover:bg-slate-50 transition-all">
                                <td class="px-6 py-5 bg-slate-50 group-hover:bg-blue-50/50 rounded-l-4xl border-y border-l border-transparent group-hover:border-blue-100">
                                    <div class="flex items-center gap-4">
                                        <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-primary shadow-sm border border-slate-100 overflow-hidden">
                                            <span class="material-symbols-outlined text-2xl fill-icon">diamond</span>
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800">Mentoria VIP Mensal</p>
                                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tight">Serviço</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 bg-slate-50 group-hover:bg-blue-50/50 border-y border-transparent group-hover:border-blue-100">
                                    <p class="font-black text-slate-800">R$ 2.500,00</p>
                                </td>
                                <td class="px-6 py-5 bg-slate-50 group-hover:bg-blue-50/50 border-y border-transparent group-hover:border-blue-100">
                                    <p class="font-bold text-slate-600">45</p>
                                </td>
                                <td class="px-6 py-5 bg-slate-50 group-hover:bg-blue-50/50 border-y border-transparent group-hover:border-blue-100">
                                    <p class="font-black text-blue-600">R$ 112.500</p>
                                </td>
                                <td class="px-6 py-5 bg-slate-50 group-hover:bg-blue-50/50 border-y border-transparent group-hover:border-blue-100">
                                    <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-[10px] font-black uppercase">Ativo</span>
                                </td>
                                <td class="px-6 py-5 bg-slate-50 group-hover:bg-blue-50/50 rounded-r-4xl border-y border-r border-transparent group-hover:border-blue-100 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button class="w-9 h-9 flex items-center justify-center text-slate-400 hover:text-primary hover:bg-white rounded-full transition-all border border-transparent hover:border-slate-200">
                                            <span class="material-symbols-outlined text-xl">edit</span>
                                        </button>
                                        <button class="w-9 h-9 flex items-center justify-center text-slate-400 hover:text-primary hover:bg-white rounded-full transition-all border border-transparent hover:border-slate-200">
                                            <span class="material-symbols-outlined text-xl">link</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="group hover:bg-slate-50 transition-all">
                                <td class="px-6 py-5 bg-slate-50 group-hover:bg-blue-50/50 rounded-l-4xl border-y border-l border-transparent group-hover:border-blue-100">
                                    <div class="flex items-center gap-4">
                                        <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-primary shadow-sm border border-slate-100 overflow-hidden">
                                            <span class="material-symbols-outlined text-2xl fill-icon">diamond</span>
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800">Mentoria VIP Mensal</p>
                                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tight">Serviço</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 bg-slate-50 group-hover:bg-blue-50/50 border-y border-transparent group-hover:border-blue-100">
                                    <p class="font-black text-slate-800">R$ 2.500,00</p>
                                </td>
                                <td class="px-6 py-5 bg-slate-50 group-hover:bg-blue-50/50 border-y border-transparent group-hover:border-blue-100">
                                    <p class="font-bold text-slate-600">45</p>
                                </td>
                                <td class="px-6 py-5 bg-slate-50 group-hover:bg-blue-50/50 border-y border-transparent group-hover:border-blue-100">
                                    <p class="font-black text-blue-600">R$ 112.500</p>
                                </td>
                                <td class="px-6 py-5 bg-slate-50 group-hover:bg-blue-50/50 border-y border-transparent group-hover:border-blue-100">
                                    <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-[10px] font-black uppercase">Ativo</span>
                                </td>
                                <td class="px-6 py-5 bg-slate-50 group-hover:bg-blue-50/50 rounded-r-4xl border-y border-r border-transparent group-hover:border-blue-100 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button class="w-9 h-9 flex items-center justify-center text-slate-400 hover:text-primary hover:bg-white rounded-full transition-all border border-transparent hover:border-slate-200">
                                            <span class="material-symbols-outlined text-xl">edit</span>
                                        </button>
                                        <button class="w-9 h-9 flex items-center justify-center text-slate-400 hover:text-primary hover:bg-white rounded-full transition-all border border-transparent hover:border-slate-200">
                                            <span class="material-symbols-outlined text-xl">link</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="group hover:bg-slate-50 transition-all">
                                <td class="px-6 py-5 bg-slate-50 group-hover:bg-blue-50/50 rounded-l-4xl border-y border-l border-transparent group-hover:border-blue-100">
                                    <div class="flex items-center gap-4">
                                        <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-primary shadow-sm border border-slate-100 overflow-hidden">
                                            <span class="material-symbols-outlined text-2xl fill-icon">auto_stories</span>
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800">Ebook: Marketing de Elite</p>
                                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tight">Infoproduto</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 bg-slate-50 group-hover:bg-blue-50/50 border-y border-transparent group-hover:border-blue-100">
                                    <p class="font-black text-slate-800">R$ 97,00</p>
                                </td>
                                <td class="px-6 py-5 bg-slate-50 group-hover:bg-blue-50/50 border-y border-transparent group-hover:border-blue-100">
                                    <p class="font-bold text-slate-600">3.412</p>
                                </td>
                                <td class="px-6 py-5 bg-slate-50 group-hover:bg-blue-50/50 border-y border-transparent group-hover:border-blue-100">
                                    <p class="font-black text-blue-600">R$ 330.964</p>
                                </td>
                                <td class="px-6 py-5 bg-slate-50 group-hover:bg-blue-50/50 border-y border-transparent group-hover:border-blue-100">
                                    <span class="px-3 py-1 bg-amber-100 text-amber-600 rounded-full text-[10px] font-black uppercase">Pausado</span>
                                </td>
                                <td class="px-6 py-5 bg-slate-50 group-hover:bg-blue-50/50 rounded-r-4xl border-y border-r border-transparent group-hover:border-blue-100 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button class="w-9 h-9 flex items-center justify-center text-slate-400 hover:text-primary hover:bg-white rounded-full transition-all border border-transparent hover:border-slate-200">
                                            <span class="material-symbols-outlined text-xl">edit</span>
                                        </button>
                                        <button class="w-9 h-9 flex items-center justify-center text-slate-400 hover:text-primary hover:bg-white rounded-full transition-all border border-transparent hover:border-slate-200">
                                            <span class="material-symbols-outlined text-xl">link</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="flex items-center justify-between mt-10 px-6">
                        <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Mostrando 3 de 12 produtos</p>
                        <div class="flex items-center gap-2">
                            <button class="w-10 h-10 flex items-center justify-center bg-white border border-slate-100 text-slate-400 rounded-full hover:border-primary hover:text-primary transition-all">
                                <span class="material-symbols-outlined">chevron_left</span>
                            </button>
                            <button class="w-10 h-10 flex items-center justify-center bg-primary text-white rounded-full shadow-md shadow-blue-500/20 font-bold text-xs">1</button>
                            <button class="w-10 h-10 flex items-center justify-center bg-white border border-slate-100 text-slate-600 rounded-full font-bold text-xs hover:border-primary hover:text-primary transition-all">2</button>
                            <button class="w-10 h-10 flex items-center justify-center bg-white border border-slate-100 text-slate-600 rounded-full font-bold text-xs hover:border-primary hover:text-primary transition-all">3</button>
                            <button class="w-10 h-10 flex items-center justify-center bg-white border border-slate-100 text-slate-400 rounded-full hover:border-primary hover:text-primary transition-all">
                                <span class="material-symbols-outlined">chevron_right</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="px-12 py-6 text-center shrink-0">
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">© 2024 FinPay Blue Aesthetic</p>
            </footer>
        </main>
    </div>
</div>
