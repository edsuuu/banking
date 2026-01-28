<main class="flex-1 flex flex-col bg-white main-container-rounded shadow-[0_10px_40px_rgba(0,0,0,0.04)] overflow-hidden border border-slate-100">
    <header class="h-24 flex items-center justify-between px-12 border-b border-slate-50 shrink-0">
        <div class="flex items-center gap-2 text-sm font-medium">
            <span class="material-symbols-outlined text-slate-400 text-lg">home</span>
            <span class="text-slate-400">Home</span>
            <span class="text-slate-300">/</span>
            <a href="{{ route('products.index') }}" wire:navigate class="text-slate-400 hover:text-primary transition-colors">Produtos</a>
            <span class="text-slate-300">/</span>
            <span class="text-primary font-bold">Novo Produto</span>
        </div>
        <div class="flex items-center gap-4">
            <button class="w-11 h-11 flex items-center justify-center text-slate-400 hover:bg-slate-50 rounded-full transition-all relative">
                <span class="material-symbols-outlined text-xl">notifications</span>
                <span class="absolute top-3.5 right-3.5 w-1.5 h-1.5 bg-blue-600 rounded-full border border-white"></span>
            </button>
            <div class="h-8 w-px bg-slate-100"></div>
            <button class="flex items-center gap-2 px-4 py-2 bg-blue-50 text-primary rounded-full font-bold text-xs hover:bg-blue-100 transition-all">
                <span class="material-symbols-outlined text-sm fill-icon">verified_user</span>
                Conta Verificada
            </button>
        </div>
    </header>
    <div class="flex-1 overflow-y-auto p-12 custom-scrollbar flex justify-center">
        <div class="w-full max-w-[800px]">
            <div class="mb-10">
                <h2 class="text-3xl font-extrabold tracking-tight text-slate-800">Cadastrar Novo Produto</h2>
                <p class="text-slate-400 mt-1 font-medium">Preencha os dados abaixo para disponibilizar sua oferta.</p>
            </div>
            <form wire:submit="submit" class="space-y-10">
                <section>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-8 h-8 rounded-full bg-blue-50 text-primary flex items-center justify-center">
                            <span class="material-symbols-outlined text-lg">info</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800 tracking-tight">Informações Básicas</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-4">Nome do Produto</label>
                            <input wire:model="name" class="bg-slate-50 border-transparent focus:border-primary focus:ring-0 rounded-3xl w-full text-sm font-medium placeholder:text-slate-400 transition-all px-6 py-3.5" placeholder="Ex: Masterclass Finanças 2.0" type="text"/>
                            @error('name') <span class="text-red-500 text-xs ml-4">{{ $message }}</span> @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-4">Categoria</label>
                            <div class="flex gap-2">
                                <select wire:model="category_id" class="bg-slate-50 border-transparent focus:border-primary focus:ring-0 rounded-3xl w-full text-sm font-medium placeholder:text-slate-400 transition-all px-6 py-3.5 appearance-none flex-1">
                                    <option value="">Selecione uma categoria</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <button type="button" wire:click="$dispatch('openModal', { component: 'products.category-modal' })" class="w-12 h-12 shrink-0 flex items-center justify-center bg-blue-50 text-primary rounded-2xl hover:bg-blue-100 transition-colors" title="Nova Categoria">
                                    <span class="material-symbols-outlined">add</span>
                                </button>
                            </div>
                            @error('category_id') <span class="text-red-500 text-xs ml-4">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </section>
                <section>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-8 h-8 rounded-full bg-blue-50 text-primary flex items-center justify-center">
                            <span class="material-symbols-outlined text-lg">payments</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800 tracking-tight">Preificação</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-4">Preço (R$)</label>
                            <div class="relative">
                                <span class="absolute left-6 top-1/2 -translate-y-1/2 font-bold text-slate-400 text-sm">R$</span>
                                <input wire:model="price" x-on:input="$el.value = window.moneyMask($el.value, 12)" class="bg-slate-50 border-transparent focus:border-primary focus:ring-0 rounded-3xl w-full text-sm font-medium placeholder:text-slate-400 transition-all pl-14 pr-6 py-3.5" placeholder="0,00" type="text"/>
                            </div>
                            @error('price') <span class="text-red-500 text-xs ml-4">{{ $message }}</span> @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-4">Tipo de Pagamento</label>
                            <div class="flex p-1.5 bg-slate-50 rounded-3xl">
                                <button type="button" wire:click="$set('payment_type', 'single')" @class(['flex-1 py-2 text-xs font-bold rounded-2xl shadow-sm transition-all cursor-pointer', 'bg-white text-primary' => $payment_type === 'single', 'text-slate-500 hover:bg-slate-100' => $payment_type !== 'single'])>Único</button>
                                <button type="button" wire:click="$set('payment_type', 'subscription')" @class(['flex-1 py-2 text-xs font-bold rounded-2xl shadow-sm transition-all cursor-pointer', 'bg-white text-primary' => $payment_type === 'subscription', 'text-slate-500 hover:bg-slate-100' => $payment_type !== 'subscription'])>Assinatura</button>
                            </div>
                             @error('payment_type') <span class="text-red-500 text-xs ml-4">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </section>
                <section>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-8 h-8 rounded-full bg-blue-50 text-primary flex items-center justify-center">
                            <span class="material-symbols-outlined text-lg">subject</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800 tracking-tight">Descrição</h3>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-4">Sobre o produto</label>
                        <textarea wire:model="description" class="bg-slate-50 border-transparent focus:border-primary focus:ring-0 rounded-2xl w-full text-sm font-medium placeholder:text-slate-400 transition-all px-6 py-3.5 resize-none" placeholder="Descreva os principais benefícios e detalhes do seu produto..." rows="4"></textarea>
                         @error('description') <span class="text-red-500 text-xs ml-4">{{ $message }}</span> @enderror
                    </div>
                </section>
                <section>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-8 h-8 rounded-full bg-blue-50 text-primary flex items-center justify-center">
                            <span class="material-symbols-outlined text-lg">image</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800 tracking-tight">Imagem do Produto</h3>
                    </div>
                    <div class="border-2 border-dashed border-slate-200 rounded-4xl p-10 hover:border-primary/40 hover:bg-blue-50/20 transition-all cursor-pointer group relative">
                        <input type="file" wire:model="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="flex flex-col items-center text-center">
                             <div class="w-full aspect-video max-w-xs bg-slate-50 rounded-3xl flex items-center justify-center mb-4 overflow-hidden group-hover:scale-105 transition-transform">
                                 @if($image)
                                    <img src="{{ $image->temporaryUrl() }}" class="w-full h-full object-cover">
                                 @else
                                    <span class="material-symbols-outlined text-slate-400 text-3xl group-hover:text-primary">upload_file</span>
                                 @endif
                            </div>
                            <p class="text-sm font-bold text-slate-700">Arraste uma imagem ou clique para selecionar</p>
                            <p class="text-xs text-slate-400 mt-1 font-medium">Formatos aceitos: JPG, PNG ou WebP. Máx 5MB.</p>
                        </div>
                    </div>
                    @error('image') <span class="text-red-500 text-xs ml-4">{{ $message }}</span> @enderror
                </section>
                <div class="pt-10 flex items-center gap-4 border-t border-slate-50">
                    <button class="flex-1 px-8 py-4 gradient-blue text-white rounded-full font-bold text-sm shadow-xl shadow-blue-500/30 hover:scale-[1.02] transition-all flex items-center justify-center gap-2" type="submit">
                       <span wire:loading.remove>Criar Produto</span>
                       <span wire:loading class="material-symbols-outlined animate-spin">progress_activity</span>
                    </button>
                    <a href="{{ route('products.index') }}" wire:navigate class="px-8 py-4 bg-slate-100 text-slate-500 rounded-full font-bold text-sm hover:bg-slate-200 transition-all">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
    <footer class="px-12 py-6 text-center shrink-0">
        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">© 2024 FinPay Blue Aesthetic</p>
    </footer>
</main>
