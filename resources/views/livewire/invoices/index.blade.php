<div>
    <div class="w-full mx-auto flex overflow-hidden gap-4 px-4">
        <main
            class="flex-1 flex flex-col bg-white main-container-rounded shadow-[0_10px_40px_rgba(0,0,0,0.04)] overflow-hidden border border-slate-100">
            <header class="h-24 flex items-center justify-between px-12 border-b border-slate-50 shrink-0">
                <div class="flex items-center gap-3 text-sm font-medium">
                    <span class="material-symbols-outlined text-primary text-xl">description</span>
                    <span class="text-slate-900 font-bold">Gestão de Cobranças</span>
                </div>
                <div class="flex items-center gap-4">
                    <button
                        class="px-6 py-2.5 bg-primary text-white rounded-full font-bold text-sm hover:opacity-90 transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg">add</span>
                        Nova Cobrança
                    </button>
                    <div class="w-px h-8 bg-slate-100 mx-2"></div>
                    <button
                        class="w-11 h-11 flex items-center justify-center text-slate-400 hover:bg-slate-50 rounded-full transition-all relative">
                        <span class="material-symbols-outlined text-xl">notifications</span>
                        <span
                            class="absolute top-3.5 right-3.5 w-1.5 h-1.5 bg-blue-600 rounded-full border border-white"></span>
                    </button>
                </div>
            </header>
            <div class="flex-1 overflow-y-auto p-12 custom-scrollbar">
                <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
                    <div>
                        <h2 class="text-3xl font-extrabold tracking-tight text-slate-800">Suas Cobranças</h2>
                        <p class="text-slate-400 mt-1 font-medium">Gerencie faturas, links de pagamento e status de
                            recebimento.</p>
                    </div>
                    <div class="flex gap-3">
                        <div class="relative">
                            <span
                                class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg">search</span>
                            <input
                                class="pl-11 pr-6 py-3 bg-slate-50 border-none rounded-full text-sm font-medium w-64 focus:ring-2 focus:ring-primary/20 transition-all"
                                placeholder="Buscar cobrança..." type="text"/>
                        </div>
                        <button
                            class="w-12 h-12 flex items-center justify-center bg-slate-50 text-slate-600 rounded-full hover:bg-slate-100 transition-all">
                            <span class="material-symbols-outlined">filter_list</span>
                        </button>
                    </div>
                </div>
                <div class="flex flex-wrap lg:flex-nowrap gap-6 mb-12">
                    <div
                        class="flex-1 min-w-[300px] bg-primary rounded-4xl p-8 text-white shadow-xl shadow-blue-600/10 hover:shadow-blue-600/20 transition-all">
                        <div class="flex justify-between items-start mb-6">
                            <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center">
                                <span class="material-symbols-outlined text-white">payments</span>
                            </div>
                            <div
                                class="px-3 py-1 bg-white/20 rounded-full text-[10px] font-bold uppercase tracking-wider">
                                Total Mês
                            </div>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-[0.1em] opacity-80 mb-2">Total de
                                Cobranças</p>
                            <h3 class="text-3xl font-black">R$ 242.150,00</h3>
                        </div>
                    </div>
                    <div
                        class="flex-1 min-w-[300px] bg-white border border-slate-100 rounded-4xl p-8 shadow-sm hover:shadow-md transition-all">
                        <div class="flex justify-between items-start mb-6">
                            <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined fill-icon">check_circle</span>
                            </div>
                            <div
                                class="px-3 py-1 bg-blue-50 text-primary rounded-full text-[10px] font-bold uppercase tracking-wider">
                                Liquidadas
                            </div>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-[0.1em] text-slate-400 mb-2">Total
                                Recebido</p>
                            <h3 class="text-3xl font-black text-slate-800">R$ 185.400,00</h3>
                        </div>
                    </div>
                    <div
                        class="flex-1 min-w-[300px] bg-white border border-slate-100 rounded-4xl p-8 shadow-sm hover:shadow-md transition-all">
                        <div class="flex justify-between items-start mb-6">
                            <div class="w-12 h-12 bg-sky-50 rounded-2xl flex items-center justify-center text-sky-500">
                                <span class="material-symbols-outlined">schedule</span>
                            </div>
                            <div
                                class="px-3 py-1 bg-sky-50 text-sky-500 rounded-full text-[10px] font-bold uppercase tracking-wider">
                                Aguardando
                            </div>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-[0.1em] text-slate-400 mb-2">Pendente de
                                Pagamento</p>
                            <h3 class="text-3xl font-black text-slate-800">R$ 56.750,00</h3>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-5xl overflow-hidden border border-slate-100">
                    <div class="p-8 border-b border-slate-50 flex items-center justify-between">
                        <h4 class="text-xl font-bold text-slate-800">Histórico de Cobranças</h4>
                        <div class="flex gap-2">
                            <button class="px-4 py-2 text-xs font-bold text-primary bg-blue-50 rounded-full">Todas
                            </button>
                            <button
                                class="px-4 py-2 text-xs font-bold text-slate-400 hover:text-slate-600 transition-all">
                                Pagas
                            </button>
                            <button
                                class="px-4 py-2 text-xs font-bold text-slate-400 hover:text-slate-600 transition-all">
                                Pendentes
                            </button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                            <tr class="text-slate-400 text-[10px] uppercase font-bold tracking-widest">
                                <th class="px-8 py-6">Cliente / ID</th>
                                <th class="px-8 py-6">Data Criada</th>
                                <th class="px-8 py-6">Vencimento</th>
                                <th class="px-8 py-6">Valor</th>
                                <th class="px-8 py-6">Status</th>
                                <th class="px-8 py-6"></th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                            <tr class="hover:bg-slate-50/50 transition-all group">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-10 h-10 bg-blue-100 rounded-2xl flex items-center justify-center text-primary font-bold text-xs">
                                            MA
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800 text-sm">Marcos Andrade</p>
                                            <p class="text-[10px] text-slate-400 font-medium">#FIN-98231</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-sm text-slate-500 font-medium">12 Mai, 2024</td>
                                <td class="px-8 py-6 text-sm text-slate-500 font-medium">20 Mai, 2024</td>
                                <td class="px-8 py-6 font-black text-slate-800">R$ 1.450,00</td>
                                <td class="px-8 py-6">
<span
    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 text-primary text-[10px] font-black uppercase">
<span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                                        Pago
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <button
                                        class="w-10 h-10 rounded-full flex items-center justify-center text-slate-300 hover:text-primary hover:bg-white hover:shadow-sm transition-all">
                                        <span class="material-symbols-outlined">more_horiz</span>
                                    </button>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50/50 transition-all group">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-10 h-10 bg-slate-100 rounded-2xl flex items-center justify-center text-slate-500 font-bold text-xs">
                                            CL
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800 text-sm">Carla Lima</p>
                                            <p class="text-[10px] text-slate-400 font-medium">#FIN-98240</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-sm text-slate-500 font-medium">11 Mai, 2024</td>
                                <td class="px-8 py-6 text-sm text-slate-500 font-medium">18 Mai, 2024</td>
                                <td class="px-8 py-6 font-black text-slate-800">R$ 890,20</td>
                                <td class="px-8 py-6">
<span
    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-sky-50 text-sky-500 text-[10px] font-black uppercase">
<span class="w-1.5 h-1.5 rounded-full bg-sky-400"></span>
                                        Pendente
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <button
                                        class="w-10 h-10 rounded-full flex items-center justify-center text-slate-300 hover:text-primary hover:bg-white hover:shadow-sm transition-all">
                                        <span class="material-symbols-outlined">more_horiz</span>
                                    </button>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50/50 transition-all group">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-10 h-10 bg-blue-100 rounded-2xl flex items-center justify-center text-primary font-bold text-xs">
                                            RS
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800 text-sm">Rodrigo Souza</p>
                                            <p class="text-[10px] text-slate-400 font-medium">#FIN-98245</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-sm text-slate-500 font-medium">10 Mai, 2024</td>
                                <td class="px-8 py-6 text-sm text-slate-500 font-medium">17 Mai, 2024</td>
                                <td class="px-8 py-6 font-black text-slate-800">R$ 2.750,00</td>
                                <td class="px-8 py-6">
<span
    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 text-primary text-[10px] font-black uppercase">
<span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                                        Pago
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <button
                                        class="w-10 h-10 rounded-full flex items-center justify-center text-slate-300 hover:text-primary hover:bg-white hover:shadow-sm transition-all">
                                        <span class="material-symbols-outlined">more_horiz</span>
                                    </button>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50/50 transition-all group">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-10 h-10 bg-slate-100 rounded-2xl flex items-center justify-center text-slate-500 font-bold text-xs">
                                            BP
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800 text-sm">Beatriz Prado</p>
                                            <p class="text-[10px] text-slate-400 font-medium">#FIN-98252</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-sm text-slate-500 font-medium">09 Mai, 2024</td>
                                <td class="px-8 py-6 text-sm text-slate-500 font-medium">15 Mai, 2024</td>
                                <td class="px-8 py-6 font-black text-slate-800">R$ 412,00</td>
                                <td class="px-8 py-6">
<span
    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-sky-50 text-sky-500 text-[10px] font-black uppercase">
<span class="w-1.5 h-1.5 rounded-full bg-sky-400"></span>
                                        Pendente
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <button
                                        class="w-10 h-10 rounded-full flex items-center justify-center text-slate-300 hover:text-primary hover:bg-white hover:shadow-sm transition-all">
                                        <span class="material-symbols-outlined">more_horiz</span>
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="p-8 border-t border-slate-50 flex items-center justify-between">
                        <p class="text-xs text-slate-400 font-bold">Mostrando 4 de 156 cobranças</p>
                        <div class="flex gap-2">
                            <button
                                class="w-10 h-10 flex items-center justify-center border border-slate-100 rounded-full text-slate-400 hover:bg-slate-50 transition-all">
                                <span class="material-symbols-outlined text-sm">chevron_left</span>
                            </button>
                            <button
                                class="w-10 h-10 flex items-center justify-center bg-primary text-white rounded-full font-bold text-xs shadow-md shadow-blue-500/20">
                                1
                            </button>
                            <button
                                class="w-10 h-10 flex items-center justify-center border border-slate-100 rounded-full text-slate-600 font-bold text-xs hover:bg-slate-50">
                                2
                            </button>
                            <button
                                class="w-10 h-10 flex items-center justify-center border border-slate-100 rounded-full text-slate-600 font-bold text-xs hover:bg-slate-50">
                                3
                            </button>
                            <button
                                class="w-10 h-10 flex items-center justify-center border border-slate-100 rounded-full text-slate-400 hover:bg-slate-50 transition-all">
                                <span class="material-symbols-outlined text-sm">chevron_right</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</div>
