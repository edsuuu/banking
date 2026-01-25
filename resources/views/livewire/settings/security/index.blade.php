<div>
    <div class="flex gap-4 mb-8">
        <button wire:click="setSubTab('sessions')" class="px-6 py-2 rounded-pill text-sm font-bold transition-all {{ $subTab === 'sessions' ? 'bg-primary text-white shadow-lg shadow-blue-500/20' : 'bg-white text-slate-500 hover:bg-slate-50' }}">
            Sessões Ativas
        </button>
        <button wire:click="setSubTab('password')" class="px-6 py-2 rounded-pill text-sm font-bold transition-all {{ $subTab === 'password' ? 'bg-primary text-white shadow-lg shadow-blue-500/20' : 'bg-white text-slate-500 hover:bg-slate-50' }}">
            Alterar Senha
        </button>
    </div>

    @if($subTab === 'sessions')
        <livewire:settings.security.sessions />
    @elseif($subTab === 'password')
        <livewire:settings.security.password />
    @endif
</div>
