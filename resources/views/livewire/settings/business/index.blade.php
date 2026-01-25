<div class="grid grid-cols-1 lg:grid-cols-12 gap-10" x-data="{ isEditing: @entangle('isEditing') }">
    <div class="lg:col-span-8 space-y-8">
        <section class="bg-slate-50 rounded-4xl p-8 border border-transparent hover:border-blue-100 transition-all">
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-blue-100 text-primary flex items-center justify-center">
                        <span class="material-symbols-outlined text-2xl fill-icon">description</span>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-slate-800">Informações Fiscais</h3>
                        <p class="text-xs text-slate-400 font-medium mt-1">Dados registrados na Receita Federal.</p>
                    </div>
                </div>
                <button wire:click="toggleEdit" x-show="!isEditing" class="px-6 py-2 bg-white border border-slate-200 text-primary rounded-pill text-xs font-bold hover:bg-slate-50 transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">edit</span>
                    Editar Dados
                </button>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">CNPJ / CPF</label>
                    <input wire:model="tax_id" x-mask:dynamic="$input.length > 14 ? '99.999.999/9999-99' : '999.999.999-99'" :disabled="!isEditing" :class="!isEditing ? 'bg-slate-100 cursor-not-allowed' : 'bg-white'" class="w-full border-slate-100 rounded-2xl px-5 py-3.5 text-sm font-semibold text-slate-700 focus:ring-primary focus:border-primary transition-all" type="text"/>
                    @error('tax_id') <span class="text-red-500 text-[10px] font-bold ml-1">{{ $message }}</span> @enderror
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Tipo de Empresa</label>
                    <input wire:model="company_type" :disabled="!isEditing" :class="!isEditing ? 'bg-slate-100 cursor-not-allowed' : 'bg-white'" class="w-full border-slate-100 rounded-2xl px-5 py-3.5 text-sm font-semibold text-slate-700 focus:ring-primary focus:border-primary transition-all" type="text" placeholder="Ex: LTDA, MEI"/>
                </div>
                <div class="space-y-2 md:col-span-2">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Razão Social</label>
                    <input wire:model="legal_name" :disabled="!isEditing" :class="!isEditing ? 'bg-slate-100 cursor-not-allowed' : 'bg-white'" class="w-full border-slate-100 rounded-2xl px-5 py-3.5 text-sm font-semibold text-slate-700 focus:ring-primary focus:border-primary transition-all" type="text"/>
                    @error('legal_name') <span class="text-red-500 text-[10px] font-bold ml-1">{{ $message }}</span> @enderror
                </div>
                <div class="space-y-2 md:col-span-2">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Nome Fantasia</label>
                    <input wire:model="trading_name" :disabled="!isEditing" :class="!isEditing ? 'bg-slate-100 cursor-not-allowed' : 'bg-white'" class="w-full border-slate-100 rounded-2xl px-5 py-3.5 text-sm font-semibold text-slate-700 focus:ring-primary focus:border-primary transition-all" type="text"/>
                    @error('trading_name') <span class="text-red-500 text-[10px] font-bold ml-1">{{ $message }}</span> @enderror
                </div>
            </div>
        </section>
        
        <section class="bg-slate-50 rounded-4xl p-8 border border-transparent hover:border-blue-100 transition-all">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-12 h-12 rounded-2xl bg-blue-100 text-primary flex items-center justify-center">
                    <span class="material-symbols-outlined text-2xl fill-icon">location_on</span>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-slate-800">Endereço Comercial</h3>
                    <p class="text-xs text-slate-400 font-medium mt-1">Onde sua operação física está localizada.</p>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-6 gap-6">
                <div class="space-y-2 md:col-span-2">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">CEP</label>
                    <input wire:model.blur="zip_code" x-mask="99999-999" :disabled="!isEditing" :class="!isEditing ? 'bg-slate-100 cursor-not-allowed' : 'bg-white'" class="w-full border-slate-100 rounded-2xl px-5 py-3.5 text-sm font-semibold text-slate-700 focus:ring-primary focus:border-primary transition-all" type="text"/>
                    @error('zip_code') <span class="text-red-500 text-[10px] font-bold ml-1">{{ $message }}</span> @enderror
                </div>
                <div class="space-y-2 md:col-span-4">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Logradouro</label>
                    <input wire:model="street" :disabled="!isEditing" :class="!isEditing ? 'bg-slate-100 cursor-not-allowed' : 'bg-white'" class="w-full border-slate-100 rounded-2xl px-5 py-3.5 text-sm font-semibold text-slate-700 focus:ring-primary focus:border-primary transition-all" type="text"/>
                </div>
                <div class="space-y-2 md:col-span-1">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Número</label>
                    <input wire:model="number" :disabled="!isEditing" :class="!isEditing ? 'bg-slate-100 cursor-not-allowed' : 'bg-white'" class="w-full border-slate-100 rounded-2xl px-5 py-3.5 text-sm font-semibold text-slate-700 focus:ring-primary focus:border-primary transition-all" type="text"/>
                </div>
                <div class="space-y-2 md:col-span-2">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Complemento</label>
                    <input wire:model="complement" :disabled="!isEditing" :class="!isEditing ? 'bg-slate-100 cursor-not-allowed' : 'bg-white'" class="w-full border-slate-100 rounded-2xl px-5 py-3.5 text-sm font-semibold text-slate-700 focus:ring-primary focus:border-primary transition-all" type="text"/>
                </div>
                <div class="space-y-2 md:col-span-3">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Bairro</label>
                    <input wire:model="neighborhood" :disabled="!isEditing" :class="!isEditing ? 'bg-slate-100 cursor-not-allowed' : 'bg-white'" class="w-full border-slate-100 rounded-2xl px-5 py-3.5 text-sm font-semibold text-slate-700 focus:ring-primary focus:border-primary transition-all" type="text"/>
                </div>
                <div class="space-y-2 md:col-span-4">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Cidade</label>
                    <input wire:model="city" :disabled="!isEditing" :class="!isEditing ? 'bg-slate-100 cursor-not-allowed' : 'bg-white'" class="w-full border-slate-100 rounded-2xl px-5 py-3.5 text-sm font-semibold text-slate-700 focus:ring-primary focus:border-primary transition-all" type="text"/>
                </div>
                <div class="space-y-2 md:col-span-2">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Estado</label>
                    <select wire:model="state" :disabled="!isEditing" :class="!isEditing ? 'bg-slate-100 cursor-not-allowed' : 'bg-white'" class="w-full border-slate-100 rounded-2xl px-5 py-3.5 text-sm font-semibold text-slate-700 focus:ring-primary focus:border-primary transition-all">
                        <option value="">Selecione...</option>
                        @foreach($states as $code => $name)
                            <option value="{{ $code }}">{{ $name }} ({{ $code }})</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </section>
        
        <div class="flex justify-end gap-4 pb-12" x-show="isEditing">
            <button wire:click="cancel" class="px-8 py-4 text-sm font-bold text-slate-500 hover:bg-slate-50 rounded-pill transition-all">Descartar</button>
            <button wire:click="save" class="px-10 py-4 bg-primary text-white rounded-pill text-sm font-bold shadow-lg shadow-blue-500/20 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-sm">save</span>
                Salvar Alterações
            </button>
        </div>
    </div>
    
    <div class="lg:col-span-4 space-y-8">
        <div class="bg-blue-50/50 rounded-5xl p-8 border border-blue-100 shadow-sm relative overflow-hidden">
            <div class="relative z-10">
                <div class="w-16 h-16 bg-white rounded-3xl flex items-center justify-center mb-6 shadow-md shadow-blue-500/5">
                    <span class="material-symbols-outlined text-primary text-3xl fill-icon">domain_verification</span>
                </div>
                <h3 class="text-xl font-bold mb-2 text-slate-800 leading-tight">Verificação</h3>
                <p class="text-xs text-slate-400 font-medium mb-8 leading-relaxed">Suas informações de negócio são validadas para garantir a segurança de suas transações financeiras.</p>
                <div class="space-y-4">
                    <div class="flex items-center gap-4 bg-white/60 p-4 rounded-3xl">
                        <div class="w-10 h-10 bg-green-100 text-green-600 rounded-xl flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-xl">check</span>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-700">CNPJ Ativo</p>
                            <p class="text-[10px] text-slate-400 font-medium">Validado na Receita</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 bg-white/60 p-4 rounded-3xl">
                        <div class="w-10 h-10 bg-green-100 text-green-600 rounded-xl flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-xl">check</span>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-700">Propriedade</p>
                            <p class="text-[10px] text-slate-400 font-medium">Sócio vinculado</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Rest of the sidebar --}}
    </div>
</div>
