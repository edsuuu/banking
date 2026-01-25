  <div class="bg-white w-full  rounded-4xl shadow-2xl overflow-hidden border border-slate-100 relative z-10 my-auto animate-in fade-in zoom-in-95 duration-200">
        <div class="px-8 pt-8 pb-4 flex items-center justify-between border-b border-slate-50">
            <div>
                <h3 class="text-xl font-black text-slate-800">Histórico de Disparos</h3>
                <p class="text-xs text-slate-400 font-medium truncate max-w-md">{{ $webhook->url }}</p>
            </div>
            <button wire:click="$dispatch('closeModal')" class="cursor-pointer w-10 h-10 flex items-center justify-center rounded-full hover:bg-slate-100 transition-colors text-slate-400">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <div class="p-8 overflow-y-auto custom-scrollbar">
            @if($logs->isEmpty())
                <div class="text-center py-12">
                     <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <span class="material-symbols-outlined text-3xl text-slate-300">history_off</span>
                    </div>
                    <p class="text-slate-500 font-bold">Nenhum registro de disparo encontrado.</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($logs as $log)
                        <div x-data="{ expanded: false }" class="border border-slate-100 rounded-3xl overflow-hidden active:border-blue-100 transition-colors">
                            <div @click="expanded = !expanded" class="p-4 bg-white cursor-pointer hover:bg-slate-50 transition-colors flex items-center justify-between gap-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-xl flex items-center justify-center text-xs font-black shrink-0 
                                        {{ $log->status_code >= 200 && $log->status_code < 300 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $log->status_code ?? 'ERR' }}
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-bold text-slate-800">{{ $log->event_name }}</h4>
                                        <p class="text-[10px] text-slate-400 font-mono">{{ $log->created_at->format('d/m/Y H:i:s') }} • {{ $log->duration_ms ?? 0 }}ms</p>
                                    </div>
                                </div>
                                <span class="material-symbols-outlined text-slate-400 transition-transform duration-300" :class="expanded ? 'rotate-180' : ''">expand_more</span>
                            </div>

                            <div x-show="expanded" x-collapse style="display: none;" class="bg-slate-50 border-t border-slate-100 p-4 space-y-4">
                                <div>
                                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-1">Payload Enviado</label>
                                    <pre class="bg-slate-900 text-slate-300 p-4 rounded-xl text-xs font-mono overflow-x-auto custom-scrollbar">{{ json_encode($log->payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                </div>
                                
                                @if($log->response_body)
                                <div>
                                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-1">Resposta do Servidor</label>
                                    <pre class="bg-white border border-slate-200 text-slate-600 p-4 rounded-xl text-xs font-mono overflow-x-auto custom-scrollbar">{{ $log->response_body }}</pre>
                                </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $logs->links() }}
                </div>
            @endif
        </div>
    </div>