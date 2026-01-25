<div>
    <div class="w-full mx-auto flex overflow-hidden gap-4 px-4">
        <main class="flex-1 flex flex-col bg-white main-container-rounded shadow-[0_10px_40px_rgba(0,0,0,0.04)] overflow-hidden border border-slate-100">
            <header class="h-24 flex items-center justify-between px-12 border-b border-slate-50 shrink-0">
                <div class="flex items-center gap-3 text-sm font-medium">
                    <span class="material-symbols-outlined text-primary text-xl">webhook</span>
                    <span class="text-slate-900 font-bold">Integrações / Webhooks</span>
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
                <div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-4">
                    <div>
                        <h2 class="text-3xl font-extrabold tracking-tight text-slate-800">Webhooks</h2>
                        <p class="text-slate-400 mt-1 font-medium">Gerencie o recebimento de notificações em tempo real para sua aplicação.</p>
                    </div>
                    
                    <div class="flex items-center gap-2 bg-slate-100 p-1 rounded-full">
                        <button wire:click="setTab('webhooks')" class="px-6 py-2 rounded-full text-sm font-bold transition-all {{ $activeTab === 'webhooks' ? 'bg-white text-primary shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">
                            Meus Webhooks
                        </button>
                        <button wire:click="setTab('logs')" class="px-6 py-2 rounded-full text-sm font-bold transition-all {{ $activeTab === 'logs' ? 'bg-white text-primary shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">
                            Histórico de Logs
                        </button>
                    </div>

                    @if($activeTab === 'webhooks')
                        <button wire:click="$dispatch('openModal', { component: 'webhooks.form' })" class="flex items-center gap-2 px-8 py-4 bg-primary text-white rounded-pill font-bold shadow-lg shadow-blue-500/30 hover:scale-105 transition-all text-sm cursor-pointer">
                            <span class="material-symbols-outlined text-lg">add</span>
                            Novo Webhook
                        </button>
                    @else
                        <div class="w-[180px]"></div> <!-- Spacer -->
                    @endif
                </div>

                @if($activeTab === 'webhooks')
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                        <div class="bg-white border-2 border-slate-50 rounded-4xl p-8 flex flex-col gap-2 hover:border-blue-100 transition-all shadow-sm">
                            <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-primary mb-2">
                                <span class="material-symbols-outlined font-bold">check_circle</span>
                            </div>
                            <p class="text-xs font-bold uppercase tracking-widest text-slate-400">Total de Webhooks</p>
                            <h3 class="text-3xl font-black text-slate-800 tracking-tight">{{ str_pad($totalWebhooks, 2, '0', STR_PAD_LEFT) }}</h3>
                        </div>
                        <div class="bg-white border-2 border-slate-50 rounded-4xl p-8 flex flex-col gap-2 hover:border-blue-100 transition-all shadow-sm">
                            <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-primary mb-2">
                                <span class="material-symbols-outlined font-bold">bolt</span>
                            </div>
                            <p class="text-xs font-bold uppercase tracking-widest text-slate-400">Eventos (24h)</p>
                            <h3 class="text-3xl font-black text-slate-800 tracking-tight">{{ number_format($events24h, 0, ',', '.') }}</h3>
                        </div>
                        <div class="bg-white border-2 border-slate-50 rounded-4xl p-8 flex flex-col gap-2 hover:border-blue-100 transition-all shadow-sm">
                            <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-primary mb-2">
                                <span class="material-symbols-outlined font-bold">verified</span>
                            </div>
                            <p class="text-xs font-bold uppercase tracking-widest text-slate-400">Taxa de Sucesso</p>
                            <h3 class="text-3xl font-black text-slate-800 tracking-tight">{{ number_format($successRate, 1) }}%</h3>
                        </div>
                    </div>

                    @if($webhooks->isEmpty())
                        <div class="text-center py-16 bg-slate-50 rounded-4xl border border-slate-100">
                            <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-sm">
                                <span class="material-symbols-outlined text-3xl text-slate-300">webhook</span>
                            </div>
                            <h3 class="text-lg font-bold text-slate-700 mb-1">Nenhum webhook configurado</h3>
                            <p class="text-sm text-slate-400 font-medium">Crie seu primeiro webhook para receber notificações de eventos.</p>
                        </div>
                    @else
                        <div class="space-y-6">
                            <div class="flex items-center justify-between px-6">
                                <h4 class="text-lg font-bold text-slate-800">Endpoints Ativos</h4>
                                <div class="flex items-center gap-2">
                                    <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Status: Online</span>
                                </div>
                            </div>
                            <div class="space-y-4">
                                @foreach($webhooks as $webhook)
                                    <div class="bg-slate-50 rounded-4xl p-8 border border-transparent hover:border-blue-200 transition-all group">
                                        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                                            <div class="space-y-3 flex-1">
                                                <div class="flex items-center gap-3">
                                                    <div class="px-3 py-1 {{ $webhook->is_active ? 'bg-green-100 text-green-600' : 'bg-slate-200 text-slate-500' }} rounded-full text-[10px] font-bold uppercase tracking-wider">
                                                        {{ $webhook->is_active ? 'Ativo' : 'Inativo' }}
                                                    </div>
                                                    @if($webhook->is_active)
                                                        <span class="text-sm font-bold text-slate-800">Produção</span>
                                                    @else
                                                        <span class="text-sm font-bold text-slate-500">Inativo</span>
                                                    @endif
                                                </div>
                                                <div class="flex items-center gap-2 bg-white px-4 py-2 rounded-2xl border border-slate-100 w-fit">
                                                    <code class="text-sm font-semibold text-primary truncate max-w-[200px] md:max-w-none">{{ $webhook->url }}</code>
                                                    <button class="material-symbols-outlined text-slate-400 hover:text-primary text-lg transition-colors">content_copy</button>
                                                </div>
                                                <div class="flex flex-wrap gap-2 pt-2">
                                                    @foreach($webhook->events->take(3) as $event)
                                                        <span class="px-2 py-1 bg-blue-50 text-blue-600 rounded-lg text-[10px] font-bold">{{ $event->name }}</span>
                                                    @endforeach
                                                    @if($webhook->events->count() > 3)
                                                        <span class="px-2 py-1 bg-slate-200 text-slate-500 rounded-lg text-[10px] font-bold">+{{ $webhook->events->count() - 3 }} mais</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="flex items-center gap-6 shrink-0 lg:border-l lg:border-slate-200 lg:pl-12">
                                                <div class="text-center">
                                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Último envio</p>
                                                    <p class="text-xs font-bold text-slate-800">{{ $webhook->logs()->latest()->first()?->created_at->diffForHumans() ?? 'Nunca' }}</p>
                                                </div>
                                                <div class="flex items-center gap-2">
                                                <button wire:click="$dispatch('openModal', { component: 'webhooks.logs', params: { webhookId: {{ $webhook->id }} } })" class="w-10 h-10 rounded-full bg-white border border-slate-100 flex items-center justify-center text-slate-500 hover:text-blue-500 hover:border-blue-500 transition-all shadow-sm cursor-pointer" title="Logs">
                                                        <span class="material-symbols-outlined text-xl">history</span>
                                                    </button>
                                                <button wire:click="$dispatch('openModal', { component: 'webhooks.form', params: { webhookId: {{ $webhook->id }} } })" class="w-10 h-10 rounded-full bg-white border border-slate-100 flex items-center justify-center text-slate-500 hover:text-primary hover:border-primary transition-all shadow-sm cursor-pointer" title="Editar">
                                                        <span class="material-symbols-outlined text-xl">settings</span>
                                                    </button>
                                                    <button wire:click="toggleActive({{ $webhook->id }})" class="w-10 h-10 rounded-full bg-white border border-slate-100 flex items-center justify-center text-slate-500 hover:text-{{ $webhook->is_active ? 'red' : 'green' }}-600 hover:border-{{ $webhook->is_active ? 'red' : 'green' }}-600 transition-all shadow-sm cursor-pointer" title="{{ $webhook->is_active ? 'Desativar' : 'Ativar' }}">
                                                        <span class="material-symbols-outlined text-xl">{{ $webhook->is_active ? 'pause' : 'play_arrow' }}</span>
                                                    </button>
                                                <button wire:click="$dispatch('openModal', { component: 'webhooks.delete', params: { id: {{ $webhook->id }} } })" class="w-10 h-10 rounded-full bg-white border border-slate-100 flex items-center justify-center text-red-400 hover:bg-red-50 hover:border-red-200 transition-all shadow-sm cursor-pointer" title="Excluir">
                                                        <span class="material-symbols-outlined text-xl">delete</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @else
                    <!-- Logs Tab -->
                    <div class="space-y-6">
                        <!-- Filters -->
                        <div class="bg-white p-6 rounded-4xl border border-slate-100 shadow-sm grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-wide block mb-2">Buscar Logs</label>
                                <div class="relative">
                                    <span class="material-symbols-outlined absolute left-3 top-2.5 text-slate-400">search</span>
                                    <input wire:model.live.debounce.300ms="search" type="text" placeholder="Evento, Payload..." class="w-full pl-10 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold focus:outline-none focus:border-primary focus:ring-2 focus:ring-blue-100 transition-all" />
                                </div>
                            </div>
                            <div>
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-wide block mb-2">Evento</label>
                                <input wire:model.live.debounce.300ms="eventName" type="text" placeholder="Ex: charge.created" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold focus:outline-none focus:border-primary focus:ring-2 focus:ring-blue-100 transition-all" />
                            </div>
                            <div>
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-wide block mb-2">Status Code</label>
                                <select wire:model.live="statusCode" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold focus:outline-none focus:border-primary focus:ring-2 focus:ring-blue-100 transition-all">
                                    <option value="">Todos</option>
                                    <option value="200">200 OK</option>
                                    <option value="201">201 Created</option>
                                    <option value="400">400 Bad Request</option>
                                    <option value="401">401 Unauthorized</option>
                                    <option value="403">403 Forbidden</option>
                                    <option value="404">404 Not Found</option>
                                    <option value="500">500 Server Error</option>
                                </select>
                            </div>
                        </div>

                        <!-- Logs List -->
                        <div class="bg-slate-50 rounded-4xl border border-slate-100 overflow-hidden">
                            @if(count($logs) > 0)
                                <div class="overflow-x-auto">
                                    <table class="w-full text-left border-collapse">
                                        <thead>
                                            <tr class="bg-slate-100 border-b border-slate-200 text-xs font-bold text-slate-500 uppercase tracking-wider">
                                                <th class="px-6 py-4">Status</th>
                                                <th class="px-6 py-4">Evento</th>
                                                <th class="px-6 py-4">Webhook</th>
                                                <th class="px-6 py-4">Data/Hora</th>
                                                <th class="px-6 py-4 text-center">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-slate-100">
                                            @foreach($logs as $log)
                                                <tr class="bg-white hover:bg-blue-50/50 transition-colors">
                                                    <td class="px-6 py-4">
                                                        <span class="px-2 py-1 rounded-lg text-[10px] font-bold {{ $log->status_code >= 200 && $log->status_code < 300 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                                            {{ $log->status_code }}
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <span class="text-sm font-bold text-slate-700">{{ $log->event_name }}</span>
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <span class="text-xs font-mono text-slate-500 truncate max-w-[150px] block" title="{{ $log->webhook->url ?? 'N/A' }}">
                                                            {{ $log->webhook->url ?? 'Webhook Removido' }}
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <span class="text-xs font-medium text-slate-500">{{ $log->created_at->format('d/m/Y H:i:s') }}</span>
                                                    </td>
                                                    <td class="px-6 py-4 text-center">
                                                        <button wire:click="$dispatch('openModal', { component: 'webhooks.logs', arguments: { webhookId: {{ $log->business_webhook_id }} } })" class="text-blue-500 hover:text-blue-700 font-bold text-xs cursor-pointer">
                                                            Ver Detalhes
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="p-4 border-t border-slate-200">
                                    {{ $logs->links() }}
                                </div>
                            @else
                                <div class="text-center py-16">
                                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-sm">
                                        <span class="material-symbols-outlined text-3xl text-slate-300">history_off</span>
                                    </div>
                                    <h3 class="text-lg font-bold text-slate-700 mb-1">Nenhum log encontrado</h3>
                                    <p class="text-sm text-slate-400 font-medium">Tente ajustar seus filtros de busca.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
                <div class="mt-12 p-8 bg-blue-50/50 rounded-5xl border border-blue-100 flex items-center justify-between">
                    <div class="flex items-center gap-6">
                        <div class="w-16 h-16 bg-white rounded-3xl flex items-center justify-center text-primary shadow-sm border border-blue-50">
                            <span class="material-symbols-outlined text-3xl fill-icon">terminal</span>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-slate-800">Documentação Técnica</h4>
                            <p class="text-sm text-slate-500">Aprenda como validar assinaturas de webhooks para máxima segurança.</p>
                        </div>
                    </div>
                    <button class="px-6 py-3 bg-white border border-blue-100 rounded-pill text-xs font-bold text-primary hover:bg-primary hover:text-white transition-all shadow-sm">
                        Acessar Docs
                    </button>
                </div>
            </div>
        </main>
    </div>
</div>
