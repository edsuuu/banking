<div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
    <div class="lg:col-span-8 space-y-8" x-data="{ isEditing: @entangle('isEditing') }">
        <section class="bg-slate-50 rounded-4xl p-8 border border-transparent hover:border-blue-100 transition-all">
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <div class="w-20 h-20 rounded-3xl gradient-blue flex items-center justify-center text-white text-2xl font-black shadow-lg shadow-blue-500/30">
                            {{ substr($name, 0, 2) }}
                        </div>
                        <button class="absolute -bottom-2 -right-2 w-8 h-8 bg-white rounded-xl shadow-md flex items-center justify-center text-primary border border-slate-100 hover:bg-slate-50 transition-all">
                            <span class="material-symbols-outlined text-lg">edit</span>
                        </button>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-slate-800">Foto de Perfil</h3>
                        <p class="text-xs text-slate-400 font-medium mt-1">PNG ou JPG até 5MB. Recomendado 400x400px.</p>
                    </div>
                </div>
                
                <button wire:click="toggleEdit" x-show="!isEditing" class="px-6 py-2 bg-white border border-slate-200 text-primary rounded-pill text-xs font-bold hover:bg-slate-50 transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">edit</span>
                    Editar Perfil
                </button>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Nome Completo</label>
                    <input wire:model="name" :disabled="!isEditing" :class="!isEditing ? 'bg-slate-100 cursor-not-allowed' : 'bg-white'" class="w-full border-slate-100 rounded-2xl px-5 py-3.5 text-sm font-semibold text-slate-700 focus:ring-primary focus:border-primary transition-all" type="text"/>
                    @error('name') <span class="text-red-500 text-[10px] font-bold ml-1">{{ $message }}</span> @enderror
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">E-mail Principal</label>
                    <input wire:model="email" :disabled="!isEditing" :class="!isEditing ? 'bg-slate-100 cursor-not-allowed' : 'bg-white'" class="w-full border-slate-100 rounded-2xl px-5 py-3.5 text-sm font-semibold text-slate-700 focus:ring-primary focus:border-primary transition-all" type="email"/>
                    @error('email') <span class="text-red-500 text-[10px] font-bold ml-1">{{ $message }}</span> @enderror
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">CPF / CNPJ</label>
                    <input wire:model="document" x-mask:dynamic="$input.length > 14 ? '99.999.999/9999-99' : '999.999.999-99'" :disabled="!isEditing" :class="!isEditing ? 'bg-slate-100 cursor-not-allowed' : 'bg-white'" class="w-full border-slate-100 rounded-2xl px-5 py-3.5 text-sm font-semibold text-slate-700 focus:ring-primary focus:border-primary transition-all" type="text"/>
                    @error('document') <span class="text-red-500 text-[10px] font-bold ml-1">{{ $message }}</span> @enderror
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Telefone / WhatsApp</label>
                    <input wire:model="phone" x-mask="(99) 99999-9999" :disabled="!isEditing" :class="!isEditing ? 'bg-slate-100 cursor-not-allowed' : 'bg-white'" class="w-full border-slate-100 rounded-2xl px-5 py-3.5 text-sm font-semibold text-slate-700 focus:ring-primary focus:border-primary transition-all" type="text"/>
                    @error('phone') <span class="text-red-500 text-[10px] font-bold ml-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex justify-end gap-4 mt-8" x-show="isEditing">
                <button wire:click="cancel" class="px-8 py-4 text-sm font-bold text-slate-500 hover:bg-slate-50 rounded-pill transition-all">
                    Cancelar
                </button>
                <button wire:click="save" class="px-10 py-4 bg-primary text-white rounded-pill text-sm font-bold shadow-lg shadow-blue-500/20 hover:scale-[1.02] transition-all">
                    Salvar Alterações
                </button>
            </div>
        </section>
        
        <section class="bg-slate-50 rounded-4xl p-8 border border-transparent hover:border-blue-100 transition-all opacity-80">
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-100 text-primary rounded-xl flex items-center justify-center">
                        <span class="material-symbols-outlined">business</span>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800">Dados da Empresa</h3>
                </div>
                <button wire:click="$parent.setTab('business')" class="text-[10px] font-bold text-primary bg-white border border-blue-100 px-3 py-1 rounded-full uppercase hover:bg-blue-50 transition-all">
                    Editar aqui →
                </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Razão Social</label>
                    <input disabled class="w-full bg-slate-100 border-slate-100 rounded-2xl px-5 py-3.5 text-sm font-semibold text-slate-400 cursor-not-allowed" type="text" value="{{ $businessLegalName }}"/>
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Nome Fantasia</label>
                    <input disabled class="w-full bg-slate-100 border-slate-100 rounded-2xl px-5 py-3.5 text-sm font-semibold text-slate-400 cursor-not-allowed" type="text" value="{{ $businessTradingName }}"/>
                </div>
                <div class="space-y-2 md:col-span-2">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Endereço Fiscal</label>
                    <input disabled class="w-full bg-slate-100 border-slate-100 rounded-2xl px-5 py-3.5 text-sm font-semibold text-slate-400 cursor-not-allowed" type="text" value="{{ $businessAddress }}"/>
                </div>
            </div>
        </section>
    </div>
    
    <div class="lg:col-span-4 space-y-8">
        {{-- Sidebar content --}}
        <div class="bg-blue-50/50 rounded-5xl p-8 border border-blue-100 text-center shadow-sm">
            <div class="w-16 h-16 bg-white rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-md shadow-blue-500/5">
                <span class="material-symbols-outlined text-primary text-3xl fill-icon">shield</span>
            </div>
            <h3 class="text-xl font-bold mb-2 text-slate-800 leading-tight">Segurança</h3>
            <p class="text-xs text-slate-400 font-medium mb-8">Proteja seu acesso e suas transações.</p>
            <div class="space-y-3">
                <button wire:click="$parent.setTab('security', 'password')" class="w-full py-4 bg-white rounded-pill text-xs font-bold shadow-sm border border-slate-100 hover:border-primary hover:text-primary transition-all flex items-center px-6 gap-4 group">
                    <span class="material-symbols-outlined text-primary text-lg group-hover:scale-110 transition-transform">password</span>
                    <span>Alterar Senha</span>
                </button>
                <button wire:click="$parent.setTab('security', 'sessions')" class="w-full py-4 bg-white rounded-pill text-xs font-bold shadow-sm border border-slate-100 hover:border-primary hover:text-primary transition-all flex items-center px-6 gap-4 group">
                    <span class="material-symbols-outlined text-primary text-lg group-hover:scale-110 transition-transform">vibration</span>
                    <span>Ativar 2FA</span>
                </button>
                <button wire:click="$parent.setTab('security', 'sessions')" class="w-full py-4 bg-white rounded-pill text-xs font-bold shadow-sm border border-slate-100 hover:border-primary hover:text-primary transition-all flex items-center px-6 gap-4 group">
                    <span class="material-symbols-outlined text-primary text-lg group-hover:scale-110 transition-transform">devices</span>
                    <span>Sessões Ativas</span>
                </button>
            </div>
        </div>
        <div class="bg-gradient-to-br from-primary to-blue-400 rounded-5xl p-8 text-white relative overflow-hidden group">
            <div class="relative z-10">
                <div class="bg-white/20 text-white px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-wider w-fit mb-4">
                    Conta Premium
                </div>
                <h4 class="text-xl font-bold mb-2">FinPay Plus</h4>
                <p class="text-xs text-white/80 mb-6 leading-relaxed">Você está aproveitando o melhor que a nossa plataforma oferece.</p>
                <div class="flex items-center gap-2 mb-4">
                    <span class="material-symbols-outlined text-sm">check_circle</span>
                    <span class="text-[10px] font-bold">Taxa reduzida (1.5%)</span>
                </div>
                <button wire:click="$parent.setTab('plans')" class="bg-white/20 backdrop-blur-md text-white px-6 py-3 rounded-pill font-bold text-xs w-full hover:bg-white/30 transition-all">
                    Gerenciar Plano
                </button>
            </div>
            <span class="material-symbols-outlined absolute -bottom-6 -right-6 text-[10rem] text-white/10 rotate-12 group-hover:scale-110 transition-transform pointer-events-none">auto_awesome</span>
        </div>
        <div class="px-6 text-center">
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">© 2024 FinPay Blue</p>
        </div>
    </div>
</div>
