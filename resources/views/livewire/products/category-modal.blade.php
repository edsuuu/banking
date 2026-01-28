<div class="bg-white p-6 rounded-3xl">
    <div class="mb-6">
        <h2 class="text-xl font-extrabold tracking-tight text-slate-800">Nova Categoria</h2>
        <p class="text-slate-400 text-sm font-medium">Cadastre uma nova categoria para organizar seus produtos.</p>
    </div>
    
    <form wire:submit="save" class="space-y-6">
        <div class="space-y-2">
            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-4">Nome da Categoria</label>
            <input wire:model="name" class="form-input-rounded bg-slate-50 border-transparent focus:border-primary focus:ring-0 rounded-3xl w-full text-sm font-medium placeholder:text-slate-400 transition-all px-6 py-3.5" placeholder="Ex: Info Produtos" type="text"/>
            @error('name') <span class="text-red-500 text-xs ml-4">{{ $message }}</span> @enderror
        </div>
        
        <div class="space-y-2">
            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-4">Tipo</label>
            <select wire:model="type" class="form-input-rounded bg-slate-50 border-transparent focus:border-primary focus:ring-0 rounded-3xl w-full text-sm font-medium placeholder:text-slate-400 transition-all px-6 py-3.5 appearance-none">
                <option value="product">Produto</option>
                <option value="service">Serviço</option>
            </select>
            @error('type') <span class="text-red-500 text-xs ml-4">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button class="flex-1 px-6 py-3 gradient-blue text-white rounded-full font-bold text-sm shadow-xl shadow-blue-500/30 hover:scale-[1.02] transition-all" type="submit">
                Salvar
            </button>
            <button wire:click="$dispatch('closeModal')" class="px-6 py-3 bg-slate-100 text-slate-500 rounded-full font-bold text-sm hover:bg-slate-200 transition-all" type="button">
                Cancelar
            </button>
        </div>
    </form>
</div>
