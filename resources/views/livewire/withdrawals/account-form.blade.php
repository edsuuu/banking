<div class="bg-white w-full max-w-4xl rounded-5xl shadow-2xl overflow-hidden relative border border-slate-100">
    <!-- Header -->
    <div class="px-10 pt-10 pb-6 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-blue-50 text-primary rounded-2xl flex items-center justify-center">
                <span class="material-symbols-outlined text-2xl fill-icon">account_balance</span>
            </div>
            <div>
                <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Alterar Conta Principal</h2>
                <p class="text-slate-400 text-sm font-medium">Defina onde deseja receber seus saques.</p>
            </div>
        </div>
        <button wire:click="$dispatch('closeModal')" class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-slate-100 transition-colors text-slate-400 cursor-pointer">
            <span class="material-symbols-outlined">close</span>
        </button>
    </div>

    <!-- Content -->
    <div class="px-10 pb-10 space-y-8">
        <!-- Conta Atual -->
        @if($currentAccount)
            <div class="p-6 bg-slate-50 rounded-4xl border border-slate-100">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Conta Atual</span>
                    <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-[10px] font-bold uppercase">Ativa</span>
                </div>
                <div class="flex items-center gap-5">
                    <div class="w-14 h-14 bg-white rounded-3xl flex items-center justify-center shadow-sm">
                        <span class="material-symbols-outlined text-2xl text-slate-400">account_balance</span>
                    </div>
                    <div>
                        <p class="font-extrabold text-slate-800">{{ $currentAccount->bank_name }}</p>
                        <p class="text-sm text-slate-500 font-medium">{{ $currentAccount->formatted_account }}</p>
                        @if($currentAccount->formatted_pix_key)
                            <p class="text-xs text-primary font-medium mt-1">PIX: {{ $currentAccount->formatted_pix_key }}</p>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <div class="p-6 bg-amber-50 rounded-4xl border border-amber-100 text-center">
                <span class="material-symbols-outlined text-3xl text-amber-400 mb-2">warning</span>
                <p class="text-sm text-amber-600 font-bold">Nenhuma conta cadastrada</p>
                <p class="text-xs text-amber-500 mt-1">Cadastre uma conta para realizar saques.</p>
            </div>
        @endif

        <!-- Tabs + Conteúdo -->
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider">{{ $currentAccount ? 'Nova Conta' : 'Cadastrar Conta' }}</h3>
                <div class="flex gap-1 p-1 bg-slate-100 rounded-pill">
                    <button
                        wire:click="setTab('new')"
                        class="px-4 py-1.5 rounded-pill text-[11px] font-bold transition-all cursor-pointer {{ $activeTab === 'new' ? 'bg-white shadow-sm text-primary' : 'text-slate-500 hover:text-slate-700' }}"
                    >
                        Nova Conta
                    </button>
                    <button
                        wire:click="setTab('saved')"
                        class="px-4 py-1.5 rounded-pill text-[11px] font-bold transition-all cursor-pointer {{ $activeTab === 'saved' ? 'bg-white shadow-sm text-primary' : 'text-slate-500 hover:text-slate-700' }}"
                    >
                        Salvas ({{ $savedAccounts->count() }})
                    </button>
                </div>
            </div>

            @if($activeTab === 'new')
                <!-- Formulário Nova Conta -->
                <form wire:submit="submit" class="space-y-5">
                    <div class="grid grid-cols-1 gap-5">
                        <!-- Banco - Select2-like -->
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 ml-4">Banco</label>
                            <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                                @if($selectedBankCode)
                                    <!-- Banco selecionado -->
                                    <div class="w-full bg-slate-50 border-none rounded-pill px-6 py-4 text-sm font-semibold text-slate-700 flex items-center justify-between">
                                        <span>{{ $selectedBankCode }} - {{ $selectedBankName }}</span>
                                        <button type="button" wire:click="clearSelectedBank" class="text-slate-400 hover:text-red-500 transition-colors cursor-pointer">
                                            <span class="material-symbols-outlined text-lg">close</span>
                                        </button>
                                    </div>
                                @else
                                    <!-- Campo de busca -->
                                    <input
                                        wire:model.live.debounce.300ms="bankSearch"
                                        @focus="open = true"
                                        class="w-full bg-slate-50 border-none rounded-pill px-6 py-4 text-sm font-semibold text-slate-700 placeholder:text-slate-300 focus:ring-2 focus:ring-primary/20"
                                        placeholder="Digite o código ou nome do banco..."
                                        type="text"
                                    />
                                    <span class="material-symbols-outlined absolute right-6 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">search</span>

                                    <!-- Dropdown de resultados -->
                                    @if($this->bankResults->count() > 0)
                                        <div
                                            x-show="open"
                                            x-transition
                                            class="absolute z-50 w-full mt-2 bg-white rounded-3xl shadow-2xl border border-slate-100 max-h-64 overflow-y-auto"
                                        >
                                            @foreach($this->bankResults as $bank)
                                                <button
                                                    type="button"
                                                    wire:click="selectBank('{{ $bank['code'] }}', '{{ addslashes($bank['name']) }}')"
                                                    @click="open = false"
                                                    class="w-full px-6 py-3 text-left hover:bg-slate-50 transition-colors flex items-center gap-3 cursor-pointer"
                                                >
                                                    <span class="text-xs font-bold text-primary bg-blue-50 px-2 py-1 rounded-lg">{{ $bank['code'] }}</span>
                                                    <span class="text-sm font-medium text-slate-700 truncate">{{ $bank['name'] }}</span>
                                                </button>
                                            @endforeach
                                        </div>
                                    @elseif(strlen($bankSearch) >= 2)
                                        <div
                                            x-show="open"
                                            class="absolute z-50 w-full mt-2 bg-white rounded-3xl shadow-2xl border border-slate-100 p-6 text-center"
                                        >
                                            <span class="material-symbols-outlined text-2xl text-slate-300 mb-2">search_off</span>
                                            <p class="text-sm text-slate-400">Nenhum banco encontrado</p>
                                        </div>
                                    @endif
                                @endif
                            </div>
                            @error('selectedBankCode') <span class="text-red-500 text-xs font-bold ml-4">{{ $message }}</span> @enderror
                        </div>

                        <!-- Agência e Conta -->
                        <div class="grid grid-cols-3 gap-4">
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-500 ml-4">Agência</label>
                                <input wire:model="agency" x-mask="99999" maxlength="5" class="w-full bg-slate-50 border-none rounded-pill px-6 py-4 text-sm font-semibold text-slate-700 placeholder:text-slate-300 focus:ring-2 focus:ring-primary/20" placeholder="0000" type="text"/>
                                @error('agency') <span class="text-red-500 text-xs font-bold ml-4">{{ $message }}</span> @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-500 ml-4">Conta</label>
                                <input wire:model="account" x-mask="999999999999-9" maxlength="13" class="w-full bg-slate-50 border-none rounded-pill px-6 py-4 text-sm font-semibold text-slate-700 placeholder:text-slate-300 focus:ring-2 focus:ring-primary/20" placeholder="00000-0" type="text"/>
                                @error('account') <span class="text-red-500 text-xs font-bold ml-4">{{ $message }}</span> @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-500 ml-4">Tipo</label>
                                <select wire:model="accountType" class="w-full bg-slate-50 border-none rounded-pill px-6 py-4 text-sm font-semibold text-slate-700 focus:ring-2 focus:ring-primary/20 appearance-none cursor-pointer">
                                    <option value="corrente">Corrente</option>
                                    <option value="poupanca">Poupança</option>
                                </select>
                            </div>
                        </div>

                        <!-- Titular -->
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-500 ml-4">Nome do Titular</label>
                                <input wire:model="holderName" maxlength="100" class="w-full bg-slate-50 border-none rounded-pill px-6 py-4 text-sm font-semibold text-slate-700 placeholder:text-slate-300 focus:ring-2 focus:ring-primary/20" placeholder="Nome completo" type="text"/>
                                @error('holderName') <span class="text-red-500 text-xs font-bold ml-4">{{ $message }}</span> @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-500 ml-4">CPF/CNPJ do Titular</label>
                                <input
                                    wire:model="holderDocument"
                                    x-data
                                    x-on:input="$event.target.value = window.documentMask($event.target.value)"
                                    class="w-full bg-slate-50 border-none rounded-pill px-6 py-4 text-sm font-semibold text-slate-700 placeholder:text-slate-300 focus:ring-2 focus:ring-primary/20"
                                    placeholder="000.000.000-00"
                                    type="text"
                                />
                                @error('holderDocument') <span class="text-red-500 text-xs font-bold ml-4">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- PIX -->
                        <div class="p-5 bg-blue-50/50 rounded-3xl border border-blue-100 space-y-4">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary text-lg">bolt</span>
                                <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">Chave PIX (opcional)</label>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label class="text-xs font-bold text-slate-500 ml-4">Tipo de Chave</label>
                                    <select wire:model.live="pixKeyType" class="w-full bg-white border-none rounded-pill px-6 py-3 text-sm font-semibold text-slate-700 focus:ring-2 focus:ring-primary/20 appearance-none cursor-pointer">
                                        <option value="">Sem chave PIX</option>
                                        @foreach($pixKeyTypes as $type => $label)
                                            <option value="{{ $type }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-xs font-bold text-slate-500 ml-4">Chave</label>
                                    @if($pixKeyType === 'cpf')
                                        <input
                                            wire:model="pixKey"
                                            x-on:input="$event.target.value = window.documentMask($event.target.value)"
                                            class="w-full bg-white border-none rounded-pill px-6 py-3 text-sm font-semibold text-slate-700 placeholder:text-slate-300 focus:ring-2 focus:ring-primary/20"
                                            placeholder="000.000.000-00"
                                            type="text"
                                            maxlength="14"
                                        />
                                    @elseif($pixKeyType === 'cnpj')
                                        <input
                                            wire:model="pixKey"
                                            x-mask="99.999.999/9999-99"
                                            class="w-full bg-white border-none rounded-pill px-6 py-3 text-sm font-semibold text-slate-700 placeholder:text-slate-300 focus:ring-2 focus:ring-primary/20"
                                            placeholder="00.000.000/0000-00"
                                            type="text"
                                        />
                                    @elseif($pixKeyType === 'email')
                                        <input
                                            wire:model="pixKey"
                                            class="w-full bg-white border-none rounded-pill px-6 py-3 text-sm font-semibold text-slate-700 placeholder:text-slate-300 focus:ring-2 focus:ring-primary/20"
                                            placeholder="email@exemplo.com"
                                            type="email"
                                            maxlength="60"
                                        />
                                    @elseif($pixKeyType === 'phone')
                                        <input
                                            wire:model="pixKey"
                                            x-mask="(99) 99999-9999"
                                            class="w-full bg-white border-none rounded-pill px-6 py-3 text-sm font-semibold text-slate-700 placeholder:text-slate-300 focus:ring-2 focus:ring-primary/20"
                                            placeholder="(11) 99999-9999"
                                            type="text"
                                            maxlength="15"
                                        />
                                    @elseif($pixKeyType === 'random')
                                        <input
                                            wire:model="pixKey"
                                            x-data
                                            x-on:input="$event.target.value = window.uuidMask($event.target.value)"
                                            class="w-full bg-white border-none rounded-pill px-6 py-3 text-sm font-semibold text-slate-700 placeholder:text-slate-300 focus:ring-2 focus:ring-primary/20 font-mono"
                                            placeholder="xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx"
                                            type="text"
                                            maxlength="36"
                                        />
                                    @else
                                        <input
                                            disabled
                                            class="w-full bg-slate-100 border-none rounded-pill px-6 py-3 text-sm font-semibold text-slate-400 cursor-not-allowed"
                                            placeholder="Selecione um tipo"
                                            type="text"
                                        />
                                    @endif
                                    @error('pixKey') <span class="text-red-500 text-xs font-bold ml-4">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Botões -->
                    <div class="pt-6 flex gap-4">
                        <button wire:click="$dispatch('closeModal')" type="button" class="flex-1 py-4 px-6 border border-slate-100 rounded-pill text-sm font-bold text-slate-400 hover:bg-slate-50 transition-all cursor-pointer">
                            Cancelar
                        </button>
                        <button type="submit" class="flex-2 py-4 px-6 bg-primary text-white rounded-pill text-sm font-extrabold shadow-lg shadow-blue-500/30 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-2 cursor-pointer">
                            <span wire:loading.remove wire:target="submit" class="material-symbols-outlined text-lg">check_circle</span>
                            <span wire:loading.remove wire:target="submit">Salvar Conta</span>
                            <span wire:loading wire:target="submit" class="material-symbols-outlined animate-spin text-lg">progress_activity</span>
                            <span wire:loading wire:target="submit">Salvando...</span>
                        </button>
                    </div>
                </form>
            @else
                <!-- Lista de Contas Salvas -->
                <div class="space-y-4">
                    @forelse($savedAccounts as $savedAccount)
                        <div class="p-5 bg-slate-50 rounded-3xl border border-slate-100 flex items-center justify-between group hover:border-primary/30 transition-all">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-sm">
                                    <span class="material-symbols-outlined text-xl text-slate-400">account_balance</span>
                                </div>
                                <div>
                                    <p class="font-bold text-slate-800">{{ $savedAccount->bank_name }}</p>
                                    <p class="text-xs text-slate-500 font-medium">{{ $savedAccount->formatted_account }}</p>
                                    @if($savedAccount->formatted_pix_key)
                                        <p class="text-xs text-primary font-medium">PIX: {{ $savedAccount->formatted_pix_key }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <button
                                    wire:click="selectSavedAccount({{ $savedAccount->id }})"
                                    wire:loading.attr="disabled"
                                    class="px-4 py-2 bg-primary text-white rounded-pill text-xs font-bold hover:scale-105 transition-all cursor-pointer"
                                >
                                    <span wire:loading.remove wire:target="selectSavedAccount({{ $savedAccount->id }})">Usar</span>
                                    <span wire:loading wire:target="selectSavedAccount({{ $savedAccount->id }})">...</span>
                                </button>
                                <button
                                    wire:click="deleteSavedAccount({{ $savedAccount->id }})"
                                    wire:confirm="Deseja excluir esta conta?"
                                    class="w-9 h-9 flex items-center justify-center text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-xl transition-all cursor-pointer"
                                >
                                    <span class="material-symbols-outlined text-lg">delete</span>
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="p-12 bg-slate-50 rounded-4xl text-center">
                            <span class="material-symbols-outlined text-5xl text-slate-300 mb-4">savings</span>
                            <p class="text-slate-400 font-bold">Nenhuma conta salva</p>
                            <p class="text-xs text-slate-400 mt-1">Cadastre uma nova conta para utilizá-la.</p>
                            <button wire:click="setTab('new')" class="mt-4 text-primary font-bold text-sm hover:underline cursor-pointer">
                                Cadastrar Nova Conta
                            </button>
                        </div>
                    @endforelse
                </div>

                <!-- Botão Cancelar (apenas na tab Salvas) -->
                <div class="pt-4">
                    <button wire:click="$dispatch('closeModal')" class="w-full py-4 text-slate-400 font-bold text-sm hover:text-slate-600 transition-all cursor-pointer">
                        Cancelar
                    </button>
                </div>
            @endif
        </div>
    </div>

    <!-- Footer -->
    <div class="bg-blue-50 px-10 py-4 flex items-center gap-3">
        <span class="material-symbols-outlined text-primary text-sm">security</span>
        <p class="text-[10px] font-bold text-blue-600/70 uppercase tracking-widest">A alteração de conta passará por uma análise de segurança de 24h.</p>
    </div>
</div>
