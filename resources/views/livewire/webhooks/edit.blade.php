<div class="mx-auto flex h-[92vh] overflow-hidden gap-4 px-4 relative">
    <main class="flex-1 flex flex-col bg-white main-container-rounded shadow-[0_30px_100px_rgba(29,78,216,0.15)] overflow-hidden border border-blue-50 relative z-10">
        <header class="h-24 flex items-center justify-between px-12 border-b border-slate-50 shrink-0">
            <div class="flex items-center gap-4">
                <button wire:click="$dispatch('closeModal')" class="w-10 h-10 flex items-center justify-center bg-slate-50 hover:bg-slate-100 rounded-full transition-all text-slate-400">
                    <span class="material-symbols-outlined">arrow_back</span>
                </button>
                <div class="flex flex-col">
                    <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
                        Configurações
                    </div>
                    <h1 class="text-xl font-extrabold text-slate-800">{{ $name }}</h1>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="px-4 py-1.5 bg-green-50 text-green-600 rounded-full text-[10px] font-bold uppercase tracking-wider flex items-center gap-2 border border-green-100">
                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                    Webhook Ativo
                </div>
            </div>
        </header>
        <div class="flex-1 overflow-y-auto p-12 custom-scrollbar">
            <div class="max-w-4xl mx-auto space-y-10">
                <section>
                    <div class="mb-4">
                        <h3 class="text-lg font-bold text-slate-800">Endpoint de Destino</h3>
                        <p class="text-sm text-slate-500">A URL onde seu sistema receberá as notificações POST.</p>
                    </div>
                    <div class="relative group">
                        <input wire:model="url" class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-3xl focus:ring-4 focus:ring-blue-100 focus:border-primary transition-all font-semibold text-slate-700 outline-none pr-32" type="text" />
                        <button class="absolute right-3 top-2 bottom-2 px-6 bg-primary text-white text-xs font-bold rounded-2xl hover:bg-blue-700 transition-all shadow-sm">
                            Testar URL
                        </button>
                    </div>
                    @error('url') <span class="text-red-500 text-xs font-bold mt-1">{{ $message }}</span> @enderror
                </section>
                <section class="p-8 bg-blue-50/50 rounded-4xl border border-blue-100 border-dashed">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-bold text-slate-800">Chave Secreta (Secret Key)</h3>
                            <p class="text-sm text-slate-500">Utilize esta chave para assinar os payloads e validar a origem das requisições.</p>
                        </div>
                        <span class="material-symbols-outlined text-blue-400 text-3xl">key</span>
                    </div>
                    <div class="flex items-center gap-3 bg-white p-4 rounded-3xl border border-blue-100 shadow-sm">
                        <code class="flex-1 text-sm font-mono font-bold text-primary tracking-wider truncate px-4">whsec_5f8a2b3c4d5e6f7g8h9i0j1k2l3m4n5o6p</code>
                        <button class="flex items-center gap-2 px-4 py-2 bg-blue-50 text-primary rounded-2xl font-bold text-xs hover:bg-blue-100 transition-all">
                            <span class="material-symbols-outlined text-sm">content_copy</span>
                            Copiar
                        </button>
                    </div>
                </section>
                <section>
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-lg font-bold text-slate-800">Eventos para Disparo</h3>
                            <p class="text-sm text-slate-500">Selecione quais eventos devem notificar este endpoint.</p>
                        </div>
                        <button class="text-xs font-bold text-primary hover:underline">Selecionar Todos</button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <label class="flex items-center justify-between p-5 bg-white border-2 border-slate-100 rounded-3xl cursor-pointer hover:border-blue-200 transition-all group has-[:checked]:border-primary has-[:checked]:bg-blue-50/30">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400 group-hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined">payments</span>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-800">charge.created</p>
                                    <p class="text-[10px] font-medium text-slate-400 uppercase tracking-tighter">Cobrança Criada</p>
                                </div>
                            </div>
                            <input wire:model="events" value="charge.created" class="w-6 h-6 rounded-lg border-slate-200 text-primary focus:ring-primary shadow-sm" type="checkbox"/>
                        </label>
                        <label class="flex items-center justify-between p-5 bg-white border-2 border-slate-100 rounded-3xl cursor-pointer hover:border-blue-200 transition-all group has-[:checked]:border-primary has-[:checked]:bg-blue-50/30">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400 group-hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined">verified</span>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-800">charge.paid</p>
                                    <p class="text-[10px] font-medium text-slate-400 uppercase tracking-tighter">Pagamento Confirmado</p>
                                </div>
                            </div>
                            <input wire:model="events" value="charge.paid" class="w-6 h-6 rounded-lg border-slate-200 text-primary focus:ring-primary shadow-sm" type="checkbox"/>
                        </label>
                        <label class="flex items-center justify-between p-5 bg-white border-2 border-slate-100 rounded-3xl cursor-pointer hover:border-blue-200 transition-all group has-[:checked]:border-primary has-[:checked]:bg-blue-50/30">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400 group-hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined">undo</span>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-800">refund.success</p>
                                    <p class="text-[10px] font-medium text-slate-400 uppercase tracking-tighter">Reembolso Concluído</p>
                                </div>
                            </div>
                            <input wire:model="events" value="refund.success" class="w-6 h-6 rounded-lg border-slate-200 text-primary focus:ring-primary shadow-sm" type="checkbox"/>
                        </label>
                        <label class="flex items-center justify-between p-5 bg-white border-2 border-slate-100 rounded-3xl cursor-pointer hover:border-blue-200 transition-all group has-[:checked]:border-primary has-[:checked]:bg-blue-50/30">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400 group-hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined">error</span>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-800">charge.failed</p>
                                    <p class="text-[10px] font-medium text-slate-400 uppercase tracking-tighter">Falha no Pagamento</p>
                                </div>
                            </div>
                            <input wire:model="events" value="charge.failed" class="w-6 h-6 rounded-lg border-slate-200 text-primary focus:ring-primary shadow-sm" type="checkbox"/>
                        </label>
                        <label class="flex items-center justify-between p-5 bg-white border-2 border-slate-100 rounded-3xl cursor-pointer hover:border-blue-200 transition-all group has-[:checked]:border-primary has-[:checked]:bg-blue-50/30">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400 group-hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined">person_add</span>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-800">customer.created</p>
                                    <p class="text-[10px] font-medium text-slate-400 uppercase tracking-tighter">Novo Cliente</p>
                                </div>
                            </div>
                            <input wire:model="events" value="customer.created" class="w-6 h-6 rounded-lg border-slate-200 text-primary focus:ring-primary shadow-sm" type="checkbox"/>
                        </label>
                        <label class="flex items-center justify-between p-5 bg-white border-2 border-slate-100 rounded-3xl cursor-pointer hover:border-blue-200 transition-all group has-[:checked]:border-primary has-[:checked]:bg-blue-50/30">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400 group-hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined">update</span>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-800">subscription.updated</p>
                                    <p class="text-[10px] font-medium text-slate-400 uppercase tracking-tighter">Assinatura Atualizada</p>
                                </div>
                            </div>
                            <input wire:model="events" value="subscription.updated" class="w-6 h-6 rounded-lg border-slate-200 text-primary focus:ring-primary shadow-sm" type="checkbox"/>
                        </label>
                    </div>
                </section>
            </div>
        </div>
        <footer class="h-28 flex items-center justify-between px-12 border-t border-slate-50 shrink-0 bg-slate-50/30">
            <button wire:click="$dispatch('openModal', { component: 'webhooks.delete', params: { id: {{ $webhookId }} } })" class="flex items-center gap-2 px-6 py-3 text-red-500 hover:bg-red-50 rounded-full font-bold text-sm transition-all">
                <span class="material-symbols-outlined text-lg">delete</span>
                Remover Webhook
            </button>
            <div class="flex items-center gap-4">
                <button wire:click="$dispatch('closeModal')" class="px-8 py-3 bg-white border border-slate-200 rounded-pill font-bold text-slate-500 hover:bg-slate-100 transition-all text-sm">
                    Cancelar
                </button>
                <button wire:click="update" class="px-10 py-3 bg-primary text-white rounded-pill font-bold shadow-lg shadow-blue-500/30 hover:scale-105 transition-all text-sm flex items-center justify-center gap-2">
                    <span wire:loading.remove>Salvar Alterações</span>
                    <span wire:loading class="material-symbols-outlined animate-spin text-lg">progress_activity</span>
                    <span wire:loading>Salvando...</span>
                </button>
            </div>
        </footer>
    </main>
</div>
