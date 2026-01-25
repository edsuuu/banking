<div>
    <div class="mb-10 flex items-end justify-between">
        <div>
            <h2 class="text-3xl font-extrabold tracking-tight text-slate-800">Sessões Ativas</h2>
            <p class="text-slate-400 mt-1 font-medium">Monitore e gerencie os dispositivos conectados à sua conta.</p>
        </div>
        <button class="px-6 py-3.5 bg-red-50 text-red-600 rounded-pill text-xs font-bold border border-red-100 hover:bg-red-600 hover:text-white transition-all shadow-sm">
            Encerrar todas as sessões
        </button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        <div class="lg:col-span-12">
            <div class="bg-slate-50 rounded-4xl p-2 border border-slate-100">
                <div class="overflow-hidden">
                    <div class="bg-white rounded-3xl overflow-hidden shadow-sm">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="border-b border-slate-50">
                                    <th class="px-8 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Dispositivo &amp; Browser</th>
                                    <th class="px-8 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Localização</th>
                                    <th class="px-8 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Última Atividade</th>
                                    <th class="px-8 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-right">Ação</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                <tr class="hover:bg-blue-50/30 transition-colors">
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center text-primary">
                                                <span class="material-symbols-outlined text-2xl">laptop_mac</span>
                                            </div>
                                            <div>
                                                <div class="flex items-center gap-2">
                                                    <p class="text-sm font-bold text-slate-800">MacBook Pro 14"</p>
                                                    <span class="text-[9px] bg-green-100 text-green-600 px-2 py-0.5 rounded-full font-black uppercase">Esta Sessão</span>
                                                </div>
                                                <p class="text-xs text-slate-400 font-medium">Chrome • MacOS 14.2</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-2">
                                            <span class="material-symbols-outlined text-slate-400 text-sm">location_on</span>
                                            <span class="text-sm font-semibold text-slate-600">São Paulo, Brasil</span>
                                        </div>
                                        <p class="text-[10px] text-slate-400 ml-5">IP: 187.54.210.xx</p>
                                    </td>
                                    <td class="px-8 py-6">
                                        <p class="text-sm font-bold text-slate-800">Online Agora</p>
                                        <p class="text-xs text-slate-400 font-medium">Iniciado há 2 horas</p>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <button class="w-10 h-10 rounded-xl bg-slate-100 text-slate-400 flex items-center justify-center hover:bg-red-50 hover:text-red-500 transition-all cursor-not-allowed" title="Sessão atual não pode ser removida">
                                            <span class="material-symbols-outlined text-xl">logout</span>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="hover:bg-blue-50/30 transition-colors">
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 bg-slate-100 rounded-2xl flex items-center justify-center text-slate-500">
                                                <span class="material-symbols-outlined text-2xl">smartphone</span>
                                            </div>
                                            <div>
                                                <p class="text-sm font-bold text-slate-800">iPhone 15 Pro</p>
                                                <p class="text-xs text-slate-400 font-medium">App FinPay • iOS 17.1</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-2">
                                            <span class="material-symbols-outlined text-slate-400 text-sm">location_on</span>
                                            <span class="text-sm font-semibold text-slate-600">Rio de Janeiro, Brasil</span>
                                        </div>
                                        <p class="text-[10px] text-slate-400 ml-5">IP: 191.220.35.xx</p>
                                    </td>
                                    <td class="px-8 py-6">
                                        <p class="text-sm font-bold text-slate-800">Há 45 minutos</p>
                                        <p class="text-xs text-slate-400 font-medium">08/04/2024 às 14:22</p>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <button class="w-10 h-10 rounded-xl bg-slate-100 text-slate-400 flex items-center justify-center hover:bg-red-50 hover:text-red-500 transition-all">
                                            <span class="material-symbols-outlined text-xl">logout</span>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="hover:bg-blue-50/30 transition-colors">
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 bg-slate-100 rounded-2xl flex items-center justify-center text-slate-500">
                                                <span class="material-symbols-outlined text-2xl">desktop_windows</span>
                                            </div>
                                            <div>
                                                <p class="text-sm font-bold text-slate-800">Work Station PC</p>
                                                <p class="text-xs text-slate-400 font-medium">Firefox • Windows 11</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-2">
                                            <span class="material-symbols-outlined text-slate-400 text-sm">location_on</span>
                                            <span class="text-sm font-semibold text-slate-600">Belo Horizonte, Brasil</span>
                                        </div>
                                        <p class="text-[10px] text-slate-400 ml-5">IP: 201.17.88.xx</p>
                                    </td>
                                    <td class="px-8 py-6">
                                        <p class="text-sm font-bold text-slate-800">Ontem</p>
                                        <p class="text-xs text-slate-400 font-medium">07/04/2024 às 18:05</p>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <button class="w-10 h-10 rounded-xl bg-slate-100 text-slate-400 flex items-center justify-center hover:bg-red-50 hover:text-red-500 transition-all">
                                            <span class="material-symbols-outlined text-xl">logout</span>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-blue-50/50 border border-blue-100 rounded-4xl p-8 flex items-start gap-6">
                    <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-primary shadow-sm shrink-0">
                        <span class="material-symbols-outlined text-2xl fill-icon">shield_lock</span>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-slate-800 mb-2">Segurança em Primeiro Lugar</h4>
                        <p class="text-xs text-slate-500 leading-relaxed font-medium">Se você notar algum dispositivo desconhecido, encerre a sessão imediatamente e altere sua senha de acesso.</p>
                        <button wire:click="$parent.setSubTab('password')" class="mt-4 text-xs font-bold text-primary hover:underline">Alterar senha agora →</button>
                    </div>
                </div>
                <div class="bg-blue-600 rounded-4xl p-8 text-white relative overflow-hidden flex items-center">
                    <div class="relative z-10">
                        <h4 class="text-lg font-bold mb-2">Autenticação em Duas Etapas</h4>
                        <p class="text-xs text-white/80 leading-relaxed mb-4">Aumente a proteção da sua conta ativando o 2FA via App ou SMS.</p>
                        <button wire:click="openTwoFactorModal" class="bg-white text-primary px-6 py-2.5 rounded-pill text-xs font-bold shadow-lg shadow-blue-900/20">Configurar 2FA</button>
                    </div>
                    <span class="material-symbols-outlined absolute -right-6 -bottom-6 text-white/10 text-[8rem] rotate-12 pointer-events-none">phonelink_lock</span>
                </div>
            </div>
            <div class="mt-12 text-center pb-8">
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">© 2024 FinPay Blue • Central de Segurança</p>
            </div>
        </div>
    </div>

    @if($showTwoFactorModal)
        <livewire:settings.security.two-factor />
    @endif
</div>
