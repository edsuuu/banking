<div>
    <div class="w-full mx-auto flex  overflow-hidden gap-4 px-4">
        <main class="flex-1 flex flex-col bg-white main-container-rounded shadow-[0_10px_40px_rgba(0,0,0,0.04)] overflow-hidden border border-slate-100">
            <header class="h-24 flex items-center justify-between px-12 border-b border-slate-50 shrink-0">
                <div class="flex items-center gap-3 text-sm font-medium">
                    <span class="material-symbols-outlined text-primary text-xl">group</span>
                    <span class="text-slate-900 font-bold">Gestão de Clientes</span>
                </div>
                <div class="flex items-center gap-4">
                    <div class="relative hidden md:block">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg">search</span>
                        <input class="pl-11 pr-4 py-2.5 bg-slate-50 border-none rounded-full text-xs font-medium w-64 focus:ring-2 focus:ring-primary/20 transition-all" placeholder="Buscar cliente..." type="text"/>
                    </div>
                    <button class="w-11 h-11 flex items-center justify-center text-slate-400 hover:bg-slate-50 rounded-full transition-all">
                        <span class="material-symbols-outlined text-xl">tune</span>
                    </button>
                    <button class="flex items-center gap-2 px-6 py-3 bg-primary text-white rounded-full font-bold text-xs hover:shadow-lg hover:shadow-blue-500/30 transition-all">
                        <span class="material-symbols-outlined text-sm">add</span>
                        Adicionar Cliente
                    </button>
                </div>
            </header>
            <div class="flex-1 overflow-y-auto p-12 custom-scrollbar">
                <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-4">
                    <div>
                        <h2 class="text-3xl font-extrabold tracking-tight text-slate-800">Seus Clientes</h2>
                        <p class="text-slate-400 mt-1 font-medium">Gerencie sua base de usuários e acompanhe o engajamento.</p>
                    </div>
                    <div class="flex gap-3">
                        <div class="bg-blue-50 px-5 py-3 rounded-2xl flex flex-col">
                            <span class="text-[10px] font-bold text-primary uppercase tracking-wider">Total de Clientes</span>
                            <span class="text-xl font-black text-slate-800">1,284</span>
                        </div>
                        <div class="bg-emerald-50 px-5 py-3 rounded-2xl flex flex-col">
                            <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider">Novos (30d)</span>
                            <span class="text-xl font-black text-slate-800">142</span>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-4xl border border-slate-100 overflow-hidden shadow-sm">
                    <table class="w-full text-left border-collapse">
                        <thead>
                        <tr class="border-b border-slate-50 bg-slate-50/50">
                            <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Nome do Cliente</th>
                            <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Email</th>
                            <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Total Gasto</th>
                            <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Última Compra</th>
                            <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-right">Ações</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                        <tr class="hover:bg-blue-50/30 transition-all group">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-11 h-11 rounded-2xl bg-blue-100 flex items-center justify-center text-primary font-bold text-sm">AM</div>
                                    <div>
                                        <p class="font-bold text-slate-800">Ana Maria Silva</p>
                                        <p class="text-[10px] text-emerald-600 font-bold uppercase tracking-tight">Ativo</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="text-sm font-medium text-slate-500">ana.maria@gmail.com</span>
                            </td>
                            <td class="px-8 py-6">
                                <span class="text-sm font-black text-slate-800">R$ 1.250,00</span>
                            </td>
                            <td class="px-8 py-6">
                                <span class="text-sm font-medium text-slate-500">12 Out, 2023</span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <button class="w-10 h-10 rounded-full hover:bg-white hover:shadow-sm text-slate-400 hover:text-primary transition-all">
                                    <span class="material-symbols-outlined">more_horiz</span>
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-blue-50/30 transition-all group">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-11 h-11 rounded-2xl bg-purple-100 flex items-center justify-center text-purple-600 font-bold text-sm">RC</div>
                                    <div>
                                        <p class="font-bold text-slate-800">Ricardo Costa</p>
                                        <p class="text-[10px] text-emerald-600 font-bold uppercase tracking-tight">Ativo</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="text-sm font-medium text-slate-500">ricardo.c@outlook.com</span>
                            </td>
                            <td class="px-8 py-6">
                                <span class="text-sm font-black text-slate-800">R$ 890,45</span>
                            </td>
                            <td class="px-8 py-6">
                                <span class="text-sm font-medium text-slate-500">10 Out, 2023</span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <button class="w-10 h-10 rounded-full hover:bg-white hover:shadow-sm text-slate-400 hover:text-primary transition-all">
                                    <span class="material-symbols-outlined">more_horiz</span>
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-blue-50/30 transition-all group">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-11 h-11 rounded-2xl bg-amber-100 flex items-center justify-center text-amber-600 font-bold text-sm">BL</div>
                                    <div>
                                        <p class="font-bold text-slate-800">Beatriz Lima</p>
                                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tight">Inativo</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="text-sm font-medium text-slate-500">beatriz.lima@yahoo.com</span>
                            </td>
                            <td class="px-8 py-6">
                                <span class="text-sm font-black text-slate-800">R$ 45,90</span>
                            </td>
                            <td class="px-8 py-6">
                                <span class="text-sm font-medium text-slate-500">28 Set, 2023</span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <button class="w-10 h-10 rounded-full hover:bg-white hover:shadow-sm text-slate-400 hover:text-primary transition-all">
                                    <span class="material-symbols-outlined">more_horiz</span>
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-blue-50/30 transition-all group">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-11 h-11 rounded-2xl bg-blue-100 flex items-center justify-center text-primary font-bold text-sm">FP</div>
                                    <div>
                                        <p class="font-bold text-slate-800">Felipe Pereira</p>
                                        <p class="text-[10px] text-emerald-600 font-bold uppercase tracking-tight">Ativo</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="text-sm font-medium text-slate-500">felipe.p@gmail.com</span>
                            </td>
                            <td class="px-8 py-6">
                                <span class="text-sm font-black text-slate-800">R$ 2.450,00</span>
                            </td>
                            <td class="px-8 py-6">
                                <span class="text-sm font-medium text-slate-500">05 Out, 2023</span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <button class="w-10 h-10 rounded-full hover:bg-white hover:shadow-sm text-slate-400 hover:text-primary transition-all">
                                    <span class="material-symbols-outlined">more_horiz</span>
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="px-8 py-6 bg-slate-50/30 flex items-center justify-between border-t border-slate-50">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Exibindo 4 de 1.284 clientes</p>
                        <div class="flex gap-2">
                            <button class="w-10 h-10 rounded-2xl bg-white border border-slate-100 flex items-center justify-center text-slate-400 hover:text-primary transition-all">
                                <span class="material-symbols-outlined text-sm">chevron_left</span>
                            </button>
                            <button class="w-10 h-10 rounded-2xl bg-primary flex items-center justify-center text-white font-bold text-xs shadow-md shadow-blue-500/20">1</button>
                            <button class="w-10 h-10 rounded-2xl bg-white border border-slate-100 flex items-center justify-center text-slate-500 font-bold text-xs hover:bg-slate-50 transition-all">2</button>
                            <button class="w-10 h-10 rounded-2xl bg-white border border-slate-100 flex items-center justify-center text-slate-400 hover:text-primary transition-all">
                                <span class="material-symbols-outlined text-sm">chevron_right</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
