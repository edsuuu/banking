<div>
    <div class="mb-10 flex items-end justify-between">
        <div>
            <h2 class="text-3xl font-extrabold tracking-tight text-slate-800">Sessões Ativas</h2>
            <p class="text-slate-400 mt-1 font-medium">Monitore e gerencie os dispositivos conectados à sua conta.</p>
        </div>
        
        <div class="flex items-center gap-3">
            @if(count($selectedSessions) > 0)
                <button 
                    wire:click="confirmLogoutSelected"
                    class="px-6 py-2.5 bg-red-50 text-red-600 rounded-pill text-xs font-bold hover:bg-red-600 hover:text-white transition-all flex items-center gap-2 border border-red-100">
                    <span class="material-symbols-outlined text-sm">logout</span>
                    Encerrar Selecionadas ({{ count($selectedSessions) }})
                </button>
            @endif

            <button 
                wire:click="confirmLogoutOtherSessions"
                class="px-6 py-2.5 bg-white border border-slate-200 text-slate-600 rounded-pill text-xs font-bold hover:bg-slate-50 transition-all flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">devices_off</span>
                Encerrar Outros Dispositivos
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        <div class="lg:col-span-12">
            <div class="bg-slate-50 rounded-4xl p-2 border border-slate-100">
                <div class="overflow-hidden">
                    <div class="bg-white rounded-3xl overflow-hidden shadow-sm">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-slate-50">
                                    <th class="pl-8 py-5 w-10">
                                        <div class="flex items-center">
                                            <input type="checkbox" wire:model.live="selectAll" class="w-4 h-4 rounded-md border-slate-300 bg-white text-primary focus:ring-primary shadow-sm transition-all cursor-pointer"/>
                                        </div>
                                    </th>
                                    <th class="px-6 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-center md:text-left">Dispositivo & Browser</th>
                                    <th class="hidden md:table-cell px-6 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Endereço IP</th>
                                    <th class="px-6 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Última Atividade</th>
                                    <th class="pr-8 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-right w-32">Ação</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @foreach ($sessions as $session)
                                <tr class="hover:bg-blue-50/10 transition-colors group">
                                    <td class="pl-8 py-6">
                                        <div class="flex items-center">
                                            <input type="checkbox" wire:model.live="selectedSessions" value="{{ $session->id }}" class="w-4 h-4 rounded-md border-slate-300 bg-white text-primary focus:ring-primary shadow-sm transition-all cursor-pointer"/>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 {{ $session->is_current_device ? 'bg-blue-100 text-primary' : 'bg-slate-100 text-slate-500' }} rounded-2xl flex items-center justify-center shrink-0">
                                                <span class="material-symbols-outlined text-2xl">
                                                    @if ($session->agent->isDesktop)
                                                        laptop_mac
                                                    @else
                                                        smartphone
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="min-w-0">
                                                <div class="flex items-center gap-2">
                                                    <p class="text-sm font-bold text-slate-800 truncate">{{ $session->agent->platform }}</p>
                                                    @if ($session->is_current_device)
                                                        <span class="text-[9px] bg-green-100 text-green-600 px-2 py-0.5 rounded-full font-black uppercase shrink-0">Esta Sessão</span>
                                                    @endif
                                                </div>
                                                <p class="text-xs text-slate-400 font-medium truncate">{{ $session->agent->browser }} {{ $session->agent->version }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="hidden md:table-cell px-6 py-6">
                                        <span class="text-sm font-semibold text-slate-600">{{ $session->ip_address }}</span>
                                    </td>
                                    <td class="px-6 py-6">
                                        <p class="text-sm font-bold text-slate-800">{{ $session->last_active }}</p>
                                    </td>
                                    <td class="pr-8 py-6 text-right">
                                        <button 
                                            wire:click="confirmLogoutSingle('{{ $session->id }}')"
                                            class="inline-flex w-10 h-10 rounded-xl {{ $session->is_current_device ? 'bg-orange-50 text-orange-500 hover:bg-orange-500' : 'bg-slate-50 text-slate-400 hover:bg-red-500' }} items-center justify-center hover:text-white transition-all transform active:scale-95"
                                            title="{{ $session->is_current_device ? 'Sair do aplicativo' : 'Encerrar sessão' }}">
                                            <span class="material-symbols-outlined text-xl">{{ $session->is_current_device ? 'power_settings_new' : 'logout' }}</span>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
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
                
                @php $has2fa = auth()->user()->two_factor_confirmed_at; @endphp
                <div class="{{ $has2fa ? 'bg-green-500' : 'bg-primary' }} rounded-4xl p-8 text-white relative overflow-hidden flex items-center group transition-colors duration-500">
                    <div class="relative z-10">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="material-symbols-outlined text-lg">{{ $has2fa ? 'verified_user' : 'security' }}</span>
                            <h4 class="text-lg font-bold">Autenticação 2FA</h4>
                        </div>
                        <p class="text-xs text-white/80 leading-relaxed mb-6">
                            @if($has2fa)
                                Sua conta está protegida com a camada extra de segurança via App.
                            @else
                                Aumente a proteção da sua conta ativando o 2FA via seu aplicativo favorito.
                            @endif
                        </p>
                        <button wire:click="openTwoFactorModal" class="bg-white {{ $has2fa ? 'text-green-600' : 'text-primary' }} px-6 py-2.5 rounded-pill text-xs font-bold shadow-lg shadow-black/5 hover:scale-105 transition-all">
                            {{ $has2fa ? 'Gerenciar Proteção' : 'Configurar Agora' }}
                        </button>
                    </div>
                    <span class="material-symbols-outlined absolute -right-6 -bottom-6 text-white/10 text-[8rem] rotate-12 pointer-events-none group-hover:scale-110 transition-transform">
                        {{ $has2fa ? 'lock_open_right' : 'phonelink_lock' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Universal Confirmation Modal --}}
    @if($confirmingAction)
    <div class="fixed inset-0 z-[60] flex items-center justify-center p-4 modal-overlay overflow-y-auto backdrop-blur-sm bg-slate-900/40">
        <div class="bg-white w-full max-w-md rounded-4xl shadow-2xl overflow-hidden border border-slate-100 my-auto animate-in fade-in zoom-in duration-200">
            <div class="px-8 pt-8 pb-4 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 {{ in_array($confirmingAction, ['logout_single', 'logout_selected']) ? 'bg-orange-50 text-orange-500' : 'bg-red-50 text-red-500' }} rounded-2xl flex items-center justify-center">
                        <span class="material-symbols-outlined fill-icon text-2xl">
                            {{ in_array($confirmingAction, ['logout_single', 'logout_selected']) ? 'warning' : 'gpp_maybe' }}
                        </span>
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-slate-800">
                            {{ $confirmingAction === 'logout_others' ? 'Confirmar Senha' : 'Confirmar Ação' }}
                        </h3>
                        <p class="text-xs text-slate-400 font-medium">Controle de Segurança</p>
                    </div>
                </div>
                <button wire:click="cancelConfirmation" class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-slate-100 transition-colors text-slate-400">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <div class="px-8 pb-8 space-y-6">
                <div class="bg-slate-50 rounded-2xl p-5 border border-slate-100">
                    <p class="text-sm text-slate-600 leading-relaxed font-medium">
                        @if($confirmingAction === 'logout_single')
                            @if($sessionToLogout === Session::getId())
                                Encerrar <strong>esta sessão</strong> irá desconectar você do aplicativo imediatamente. Deseja continuar?
                            @else
                                Você tem certeza que deseja encerrar esta sessão ativa? O dispositivo perderá o acesso instantaneamente.
                            @endif
                        @elseif($confirmingAction === 'logout_selected')
                            Tem certeza que deseja encerrar as <strong>{{ count($selectedSessions) }} sessões</strong> selecionadas?
                        @elseif($confirmingAction === 'logout_others')
                            Para encerrar todos os outros dispositivos conectados, por favor confirme sua senha de acesso.
                        @endif
                    </p>
                </div>

                @if($confirmingAction === 'logout_others')
                <div class="space-y-4">
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Sua Senha</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-slate-400">lock</span>
                        <input wire:model="confirmationPassword" 
                               wire:keydown.enter="logoutOtherBrowserSessions"
                               type="password" 
                               class="w-full h-14 pl-14 bg-slate-50 border-slate-100 rounded-2xl text-sm font-bold text-slate-700 focus:ring-primary focus:border-primary focus:bg-white transition-all" 
                               placeholder="******"
                               autofocus/>
                    </div>
                    @error('confirmationPassword') <span class="text-red-500 text-[10px] font-bold block ml-1">{{ $message }}</span> @enderror
                </div>
                @endif

                <div class="flex gap-4">
                    <button wire:click="cancelConfirmation" class="flex-1 py-4 text-sm font-bold text-slate-500 hover:bg-slate-50 rounded-pill transition-all">
                        Cancelar
                    </button>
                    
                    @if($confirmingAction === 'logout_others')
                        <button wire:click="logoutOtherBrowserSessions" class="flex-1 py-4 bg-red-500 text-white rounded-pill font-bold shadow-lg shadow-red-500/20 hover:scale-[1.02] transition-all flex items-center justify-center gap-2">
                            <span>Confirmar</span>
                            <span class="material-symbols-outlined text-sm">verified_user</span>
                        </button>
                    @else
                        <button wire:click="executeLogout" class="flex-1 py-4 bg-slate-800 text-white rounded-pill font-bold shadow-lg shadow-slate-800/20 hover:scale-[1.02] transition-all flex items-center justify-center gap-2">
                            <span>Encerrar Sessão</span>
                            <span class="material-symbols-outlined text-sm">power_settings_new</span>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Two Factor Modal --}}
    @if($showTwoFactorModal)
        <livewire:settings.security.two-factor />
    @endif
</div>
