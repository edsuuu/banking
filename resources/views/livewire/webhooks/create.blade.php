<div class="mx-auto flex overflow-hidden gap-4 px-4 ">
    <div class="fixed inset-0 z-50 flex items-center justify-center p-6 modal-overlay">
        <div class="bg-white w-full max-w-xl rounded-5xl shadow-2xl shadow-blue-900/20 overflow-hidden flex flex-col">
            <div class="p-10 pb-6 border-b border-slate-100">
                <div class="flex justify-between items-start mb-2">
                    <div class="w-14 h-14 gradient-blue rounded-3xl flex items-center justify-center shadow-lg shadow-blue-500/20">
                        <span class="material-symbols-outlined text-white text-3xl">add_link</span>
                    </div>
                    <button wire:click="$dispatch('closeModal')" class="w-10 h-10 rounded-full hover:bg-slate-100 flex items-center justify-center text-slate-400 transition-colors">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
                <h3 class="text-2xl font-black text-slate-800 tracking-tight">Cadastrar Novo Webhook</h3>
                <p class="text-slate-400 font-medium text-sm mt-1">Configure o destino para as notificações automáticas da sua conta.</p>
            </div>
            <div class="p-10 space-y-8">
                <div class="space-y-3">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-widest block" for="url">URL do Endpoint</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">link</span>
                        <input wire:model="url" class="w-full bg-slate-50 border-2 border-slate-100 rounded-3xl py-4 pl-12 pr-6 text-sm font-semibold text-slate-800 focus:border-primary focus:ring-0 transition-all placeholder:text-slate-300" id="url" placeholder="https://seu-sistema.com.br/webhook" type="text" />
                    </div>
                    @error('url') <span class="text-red-500 text-xs font-bold mt-1">{{ $message }}</span> @enderror
                </div>
                <div class="space-y-3">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-widest block">Eventos para Notificar</label>
                    <div class="bg-slate-50 border-2 border-slate-100 rounded-3xl p-5 space-y-4">
                        <div class="grid grid-cols-2 gap-3">
                            <label class="flex items-center gap-3 p-3 bg-white rounded-2xl border border-slate-100 cursor-pointer hover:border-primary transition-all group">
                                <input wire:model="events" value="charge.created" class="w-5 h-5 rounded-lg border-2 border-slate-200 text-primary focus:ring-primary focus:ring-offset-0 transition-all" type="checkbox"/>
                                <span class="text-xs font-bold text-slate-700 group-hover:text-primary transition-colors">charge.created</span>
                            </label>
                            <label class="flex items-center gap-3 p-3 bg-white rounded-2xl border border-slate-100 cursor-pointer hover:border-primary transition-all group">
                                <input wire:model="events" value="charge.paid" class="w-5 h-5 rounded-lg border-2 border-slate-200 text-primary focus:ring-primary focus:ring-offset-0 transition-all" type="checkbox"/>
                                <span class="text-xs font-bold text-slate-700 group-hover:text-primary transition-colors">charge.paid</span>
                            </label>
                            <label class="flex items-center gap-3 p-3 bg-white rounded-2xl border border-slate-100 cursor-pointer hover:border-primary transition-all group">
                                <input wire:model="events" value="refund.created" class="w-5 h-5 rounded-lg border-2 border-slate-200 text-primary focus:ring-primary focus:ring-offset-0 transition-all" type="checkbox"/>
                                <span class="text-xs font-bold text-slate-700 group-hover:text-primary transition-colors">refund.created</span>
                            </label>
                            <label class="flex items-center gap-3 p-3 bg-white rounded-2xl border border-slate-100 cursor-pointer hover:border-primary transition-all group">
                                <input wire:model="events" value="subscription.updated" class="w-5 h-5 rounded-lg border-2 border-slate-200 text-primary focus:ring-primary focus:ring-offset-0 transition-all" type="checkbox"/>
                                <span class="text-xs font-bold text-slate-700 group-hover:text-primary transition-colors">subscription.updated</span>
                            </label>
                        </div>
                        @error('events') <span class="text-red-500 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider text-center">Mostrando 4 de 24 eventos disponíveis</p>
                    </div>
                </div>
            </div>
            <div class="p-10 pt-0 flex gap-4">
                <button wire:click="save" class="flex-1 px-8 py-4 bg-primary text-white rounded-pill font-bold shadow-lg shadow-blue-500/30 hover:scale-[1.02] active:scale-95 transition-all text-sm flex items-center justify-center gap-2">
                    <span wire:loading.remove>Salvar Webhook</span>
                    <span wire:loading class="material-symbols-outlined animate-spin text-lg">progress_activity</span>
                    <span wire:loading>Salvando...</span>
                </button>
                <button wire:click="$dispatch('closeModal')" class="px-8 py-4 bg-slate-100 text-slate-500 rounded-pill font-bold hover:bg-slate-200 transition-all text-sm">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

