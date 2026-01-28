<main x-data="{ showDeleteModal: false }" class="flex-1 flex flex-col bg-white main-container-rounded shadow-[0_10px_40px_rgba(0,0,0,0.04)] overflow-hidden border border-slate-100">
    <header class="h-24 flex items-center justify-between px-12 border-b border-slate-50 shrink-0">
        <div class="flex items-center gap-2 text-sm font-medium">
            <span class="material-symbols-outlined text-slate-400 text-lg">home</span>
            <span class="text-slate-400">Home</span>
            <span class="text-slate-300">/</span>
            <a href="{{ route('products.index') }}" wire:navigate class="text-slate-400 hover:text-primary transition-colors">Produtos</a>
            <span class="text-slate-300">/</span>
            <span class="text-primary font-bold">Editar</span>
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
        <div class="w-full max-w-[1000px]">
            <div class="flex items-center justify-between mb-10">
                <div>
                    <h2 class="text-3xl font-extrabold tracking-tight text-slate-800">Editar Produto</h2>
                    <p class="text-slate-400 mt-1 font-medium">Atualize as informações do seu produto digital ou serviço.</p>
                </div>
                <a class="flex items-center gap-2 text-slate-400 hover:text-slate-600 transition-all font-bold text-sm uppercase tracking-wider" href="{{ route('products.index') }}" wire:navigate>
                    <span class="material-symbols-outlined text-lg">arrow_back</span>
                    Voltar
                </a>
            </div>
            <form wire:submit="submit" class="space-y-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-1">
                        <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-4">Imagem do Produto</p>
                        <div class="relative group">
                            <div class="w-full aspect-square bg-slate-50 border-2 border-dashed border-slate-200 rounded-4xl flex flex-col items-center justify-center overflow-hidden transition-all group-hover:border-primary/30">
                                <div class="w-full h-full flex items-center justify-center bg-white overflow-hidden rounded-4xl">
                                    @if($newImage)
                                        <img src="{{ $newImage->temporaryUrl() }}" class="w-full h-full object-cover">
                                    @elseif($product->image)
                                        <img src="{{ route('files.show', $product->image->uuid) }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="material-symbols-outlined text-5xl text-primary/20 fill-icon">movie</span>
                                    @endif
                                </div>
                                <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center rounded-4xl">
                                    <button class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-primary shadow-xl pointer-events-none" type="button">
                                        <span class="material-symbols-outlined">photo_camera</span>
                                    </button>
                                </div>
                            </div>
                            <input type="file" wire:model="newImage" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            <p class="text-center mt-3 text-[10px] text-slate-400 font-bold uppercase tracking-tight">JPG, PNG ou GIF • Max 5MB</p>
                        </div>
                         @error('newImage') <span class="text-red-500 text-xs ml-4">{{ $message }}</span> @enderror
                    </div>
                    <div class="lg:col-span-2 space-y-6">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="col-span-2">
                                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Nome do Produto</label>
                                <input wire:model="name" class="bg-slate-50 border-transparent focus:border-primary focus:ring-0 rounded-2xl w-full text-sm font-semibold text-slate-800 transition-all px-6 py-4" placeholder="Ex: Curso de Marketing" type="text"/>
                                @error('name') <span class="text-red-500 text-xs ml-4">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-span-1">
                                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Preço de Venda</label>
                                <div class="relative">
                                    <span class="absolute left-6 top-1/2 -translate-y-1/2 text-slate-400 font-bold text-sm">R$</span>
                                    <input wire:model="price" x-on:input="$el.value = window.moneyMask($el.value, 12)" class="bg-slate-50 border-transparent focus:border-primary focus:ring-0 rounded-2xl w-full text-sm font-bold text-slate-800 transition-all pl-14 pr-6 py-4" type="text"/>
                                </div>
                                @error('price') <span class="text-red-500 text-xs ml-4">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-span-1">
                                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Categoria</label>
                                <select wire:model="category_id" class="bg-slate-50 border-transparent focus:border-primary focus:ring-0 rounded-2xl w-full text-sm font-semibold text-slate-800 transition-all px-6 py-4 appearance-none">
                                    <option value="">Selecione</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <span class="text-red-500 text-xs ml-4">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-span-2">
                                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Descrição Curta</label>
                                <textarea wire:model="description" class="bg-slate-50 border-transparent focus:border-primary focus:ring-0 rounded-2xl w-full text-sm font-semibold text-slate-800 transition-all px-6 py-4 resize-none" placeholder="Uma breve descrição sobre o que o cliente está comprando..." rows="3"></textarea>
                                @error('description') <span class="text-red-500 text-xs ml-4">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-8 bg-slate-50 rounded-4xl flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-primary shadow-sm border border-slate-100">
                            <span class="material-symbols-outlined fill-icon">bolt</span>
                        </div>
                        <div>
                            <p class="font-bold text-slate-800">Status do Produto</p>
                            <p class="text-xs text-slate-400 font-medium">Produtos pausados não podem ser comprados nos checkouts.</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-xs font-black uppercase text-slate-400 tracking-wider">Pausado</span>
                        <div class="relative inline-block w-12 mr-2 align-middle select-none">
                            <input wire:click="$set('status', '{{ $status === 'active' ? 'paused' : 'active' }}')" 
                                   type="checkbox" 
                                   @class([
                                       'switch-toggle absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer transition-all duration-300 outline-none z-10',
                                       'right-0 border-green-400' => $status === 'active',
                                       'left-0 border-slate-200' => $status !== 'active'
                                   ])
                                   id="toggle"/>
                            <label @class([
                                       'toggle-label block overflow-hidden h-6 rounded-full cursor-pointer transition-colors duration-300',
                                       'bg-green-200' => $status === 'active',
                                       'bg-slate-200' => $status !== 'active'
                                   ]) for="toggle"></label>
                        </div>
                        <span class="text-xs font-black uppercase text-green-600 tracking-wider">Ativo</span>
                    </div>
                </div>
                <div class="flex items-center justify-between pt-6 border-t border-slate-50">
                    <button type="button" @click="showDeleteModal = true" class="text-red-400 hover:text-red-500 font-bold text-sm flex items-center gap-2 transition-all cursor-pointer">
                        <span class="material-symbols-outlined text-lg">delete</span>
                        Excluir Produto
                    </button>
                    <div class="flex items-center gap-4">
                        <a href="{{ route('products.index') }}" wire:navigate class="px-8 py-4 text-slate-500 font-bold text-sm hover:text-slate-700 transition-all">Cancelar</a>
                        <button class="px-10 py-4 gradient-blue text-white rounded-full font-bold text-sm shadow-lg shadow-blue-500/20 hover:scale-105 active:scale-95 transition-all flex items-center gap-2 cursor-pointer" type="submit">
                            <span wire:loading.remove wire:target="submit">Salvar Alterações</span>
                            <span wire:loading wire:target="submit" class="material-symbols-outlined animate-spin">progress_activity</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <footer class="px-12 py-6 text-center shrink-0">
        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">© 2024 FinPay Blue Aesthetic • Gestão de Produtos</p>
    </footer>
    <!-- Delete Confirmation Modal -->
    <div x-show="showDeleteModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="showDeleteModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-slate-900/75 transition-opacity" aria-hidden="true" @click="showDeleteModal = false"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div x-show="showDeleteModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative z-50 inline-block align-bottom bg-white rounded-5xl text-center overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md w-full p-10">
                
                <div class="w-20 h-20 bg-red-50 rounded-3xl flex items-center justify-center text-red-500 mb-6 mx-auto">
                    <span class="material-symbols-outlined text-4xl font-bold">delete_forever</span>
                </div>
                <h3 class="text-2xl font-extrabold text-slate-800 mb-2">Apagar Produto</h3>
                <p class="text-slate-500 font-medium mb-8">Tem certeza que deseja apagar este produto? Esta ação não pode ser desfeita.</p>
                <div class="flex flex-col w-full gap-3">
                    <button type="button" wire:click="delete" class="w-full py-4 bg-red-500 text-white rounded-full font-bold shadow-lg shadow-red-500/20 hover:bg-red-600 transition-all text-sm cursor-pointer">
                        Confirmar e Apagar
                    </button>
                    <button type="button" @click="showDeleteModal = false" class="w-full py-4 bg-slate-100 text-slate-600 rounded-full font-bold hover:bg-slate-200 transition-all text-sm cursor-pointer">
                        Voltar
                    </button>
                </div>

            </div>
        </div>
    </div>
</main>
