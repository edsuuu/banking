<div>
    <div class="w-full mx-auto flex overflow-hidden gap-4 px-4">
        <main
            class="flex-1 flex flex-col bg-white main-container-rounded shadow-[0_10px_40px_rgba(0,0,0,0.04)] overflow-hidden border border-slate-100">
            <header class="h-24 flex items-center justify-between px-12 border-b border-slate-50 shrink-0">
                <div class="flex items-center gap-3 text-sm font-medium">
                    <span class="material-symbols-outlined text-primary text-xl">settings</span>
                    <span class="text-slate-900 font-bold">Configurações da Conta</span>
                </div>
                <div class="flex items-center gap-4">
                    <button
                        class="w-11 h-11 flex items-center justify-center text-slate-400 hover:bg-slate-50 rounded-full transition-all relative">
                        <span class="material-symbols-outlined text-xl">notifications</span>
                        <span
                            class="absolute top-3.5 right-3.5 w-1.5 h-1.5 bg-blue-600 rounded-full border border-white"></span>
                    </button>
                    <button
                        class="flex items-center gap-2 px-4 py-2 bg-blue-50 text-primary rounded-full font-bold text-xs hover:bg-blue-100 transition-all">
                        <span class="material-symbols-outlined text-sm fill-icon">verified_user</span>
                        Conta Verificada
                    </button>
                </div>
            </header>
            <div class="flex-1 overflow-y-auto p-12 custom-scrollbar">
                <div class="mb-10">
                    <h2 class="text-3xl font-extrabold tracking-tight text-slate-800">Ajustes &amp; Perfil</h2>
                    <p class="text-slate-400 mt-1 font-medium">Gerencie suas informações pessoais, de empresa e
                        segurança.</p>
                </div>
                <div class="flex border-b border-slate-100 mb-10 overflow-x-auto">
                    <button wire:click="setTab('profile')"
                        class="px-6 py-4 text-sm font-bold whitespace-nowrap {{ $activeTab === 'profile' ? 'tab-active' : 'text-slate-400 hover:text-primary transition-colors' }}">
                        Perfil Pessoal
                    </button>
                    <button wire:click="setTab('business')"
                        class="px-6 py-4 text-sm font-bold whitespace-nowrap {{ $activeTab === 'business' ? 'tab-active' : 'text-slate-400 hover:text-primary transition-colors' }}">
                        Dados do Negócio
                    </button>
                    <button wire:click="setTab('security')"
                        class="px-6 py-4 text-sm font-bold whitespace-nowrap {{ $activeTab === 'security' ? 'tab-active' : 'text-slate-400 hover:text-primary transition-colors' }}">
                        Segurança &amp; Senha
                    </button>
                    <button wire:click="setTab('notifications')"
                        class="px-6 py-4 text-sm font-bold whitespace-nowrap {{ $activeTab === 'notifications' ? 'tab-active' : 'text-slate-400 hover:text-primary transition-colors' }}">
                        Notificações
                    </button>
                    <button wire:click="setTab('plans')"
                        class="px-6 py-4 text-sm font-bold whitespace-nowrap {{ $activeTab === 'plans' ? 'tab-active' : 'text-slate-400 hover:text-primary transition-colors' }}">
                        Planos
                    </button>
                </div>

                <div>
                    @if($activeTab === 'profile')
                        <livewire:settings.profile.index />
                    @elseif($activeTab === 'business')
                        <livewire:settings.business.index />
                    @elseif($activeTab === 'security')
                        <livewire:settings.security.index :sub-tab="$securitySubTab" />
                    @elseif($activeTab === 'notifications')
                        <livewire:settings.notifications />
                    @elseif($activeTab === 'plans')
                        <livewire:settings.plans />
                    @endif
                </div>
            </div>
        </main>
    </div>

</div>
