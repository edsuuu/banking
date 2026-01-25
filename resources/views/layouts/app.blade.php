
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>{{ $title ?? config('app.name') }}</title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&amp;display=swap"
        rel="stylesheet"
    />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
        rel="stylesheet"
    />
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @fluxAppearance
</head>
<body class="min-h-screen bg-[#f9fafc]">

<flux:sidebar sticky stashable  class=" flex flex-col transition-all shrink-0">
        <div class="px-6 mb-10 flex items-center gap-3">
            <div
                class="w-10 h-10 gradient-blue rounded-2xl flex items-center justify-center shadow-lg shadow-blue-500/20">
                <span class="material-symbols-outlined text-white text-2xl fill-icon">account_balance</span>
            </div>
            <span class="text-2xl font-extrabold tracking-tight text-primary">FinPay</span>
        </div>
<nav class="flex-1 px-4 space-y-1 overflow-y-auto">
            <a wire:navigate class="flex items-center gap-4 px-5 py-3.5 rounded-3xl transition-all {{ request()->routeIs('dashboard') ? 'bg-primary text-white font-semibold shadow-blue-500/10 sidebar-item-active' : 'text-slate-500 hover:bg-white group' }}"
               href="{{ route('dashboard') }}">
                <span class="material-symbols-outlined text-xl group-hover:text-primary transition-colors">grid_view</span>
                <span class="text-sm font-semibold">Dashboard</span>
            </a>
            <a wire:navigate class="flex items-center gap-4 px-5 py-3.5 rounded-3xl transition-all {{ request()->routeIs('products.index') ? 'bg-primary text-white font-semibold shadow-blue-500/10 sidebar-item-active' : 'text-slate-500 hover:bg-white group' }}"
               href="{{ route('products.index') }}">
                <span
                    class="material-symbols-outlined text-xl group-hover:text-primary transition-colors">inventory_2</span>
                <span class="text-sm font-semibold">Produtos</span>
            </a>
            <a wire:navigate class="flex items-center gap-4 px-5 py-3.5 rounded-3xl transition-all {{ request()->routeIs('coupons.index') ? 'bg-primary text-white font-semibold shadow-blue-500/10 sidebar-item-active' : 'text-slate-500 hover:bg-white group' }}"
               href="{{ route('coupons.index') }}">
                <span class="material-symbols-outlined text-xl group-hover:text-primary transition-colors">sell</span>
                <span class="text-sm font-semibold">Cupons</span>
            </a>
            <a wire:navigate class="flex items-center gap-4 px-5 py-3.5 rounded-3xl transition-all {{ request()->routeIs('customers.index') ? 'bg-primary text-white font-semibold shadow-blue-500/10 sidebar-item-active' : 'text-slate-500 hover:bg-white group' }}"
               href="{{ route('customers.index') }}">
                <span class="material-symbols-outlined text-xl group-hover:text-primary transition-colors">group</span>
                <span class="text-sm font-semibold">Clientes</span>
            </a>
            <a wire:navigate class="flex items-center gap-4 px-5 py-3.5 rounded-3xl transition-all {{ request()->routeIs('invoices.index') ? 'bg-primary text-white font-semibold shadow-blue-500/10 sidebar-item-active' : 'text-slate-500 hover:bg-white group' }}"
               href="{{ route('invoices.index') }}">
                <span
                    class="material-symbols-outlined text-xl group-hover:text-primary transition-colors">description</span>
                <span class="text-sm font-semibold">Cobranças</span>
            </a>
            <a wire:navigate class="flex items-center gap-4 px-5 py-3.5 rounded-3xl transition-all {{ request()->routeIs('links.index') ? 'bg-primary text-white font-semibold shadow-blue-500/10 sidebar-item-active' : 'text-slate-500 hover:bg-white group' }}"
               href="{{ route('links.index') }}">
                <span class="material-symbols-outlined text-xl group-hover:text-primary transition-colors">link</span>
                <span class="text-sm font-semibold">Links</span>
            </a>
            <a wire:navigate class="flex items-center gap-4 px-5 py-3.5 rounded-3xl transition-all {{ request()->routeIs('withdrawals.index') ? 'bg-primary text-white font-semibold shadow-blue-500/10 sidebar-item-active' : 'text-slate-500 hover:bg-white group' }}"
               href="{{ route('withdrawals.index') }}">
                <span class="material-symbols-outlined text-xl group-hover:text-primary transition-colors">account_balance_wallet</span>
                <span class="text-sm font-semibold">Saques</span>
            </a>
            <div class="py-4">
                <hr class="border-slate-200 mx-4"/>
            </div>
            <a wire:navigate class="flex items-center gap-4 px-5 py-3.5 rounded-3xl transition-all {{ request()->routeIs('settings.index') ? 'bg-primary text-white font-semibold shadow-blue-500/10 sidebar-item-active' : 'text-slate-500 hover:bg-white group' }}"
               href="{{ route('settings.index') }}">
                <span
                    class="material-symbols-outlined text-xl group-hover:text-primary transition-colors">settings</span>
                <span class="text-sm font-semibold">Configurações</span>
            </a>
            <a wire:navigate class="flex items-center gap-4 px-5 py-3.5 rounded-3xl transition-all {{ request()->routeIs('integrations.index') ? 'bg-primary text-white font-semibold shadow-blue-500/10 sidebar-item-active' : 'text-slate-500 hover:bg-white group' }}"
               href="{{ route('integrations.index') }}">
                <span class="material-symbols-outlined text-xl group-hover:text-primary transition-colors">integration_instructions</span>
                <span class="text-sm font-semibold">Integrações</span>
            </a>
            <a wire:navigate class="flex items-center gap-4 px-5 py-3.5 rounded-3xl transition-all {{ request()->routeIs('webhooks.index') ? 'bg-primary text-white font-semibold shadow-blue-500/10 sidebar-item-active' : 'text-slate-500 hover:bg-white group' }}"
               href="{{ route('webhooks.index') }}">
                <span
                    class="material-symbols-outlined text-xl group-hover:text-primary transition-colors">webhook</span>
                <span class="text-sm font-semibold">Webhooks</span>
            </a>
        </nav>
        <div class="px-4 mt-auto mb-6">
            <div class="flex items-center gap-3 p-3 bg-white rounded-3xl shadow-sm border border-slate-100">
                <div class="w-10 h-10 rounded-full gradient-blue flex items-center justify-center text-white font-bold text-xs shrink-0">
                    {{ auth()->user() ? collect(explode(' ', auth()->user()->name))->map(fn($n) => mb_substr($n, 0, 1))->take(2)->join('') : '??' }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-[11px] font-bold truncate text-slate-800">{{ auth()->user()->name ?? 'Usuário' }}</p>
                    <p class="text-[9px] text-slate-400 font-medium truncate">{{ auth()->user()?->business?->trading_name ?? 'Personal' }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-xl bg-slate-50 text-slate-400 hover:bg-red-50 hover:text-red-500 transition-all group" title="Sair do sistema">
                        <span class="material-symbols-outlined text-lg group-hover:scale-110 transition-transform">logout</span>
                    </button>
                </form>
            </div>
        </div>
</flux:sidebar>

{{--<!-- Mobile User Menu -->--}}
{{--<flux:header class="lg:hidden">--}}
{{--    <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left"/>--}}

{{--    <flux:spacer/>--}}

{{--    <flux:dropdown position="top" align="end">--}}
{{--        <flux:profile circle :name="auth()->user()->name" class="cursor-pointer"/>--}}
{{--        <flux:menu>--}}
{{--            <form method="POST" action="{{ route('logout') }}" class="w-full">--}}
{{--                @csrf--}}
{{--                <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">--}}
{{--                    {{ __('Log Out') }}--}}
{{--                </flux:menu.item>--}}
{{--            </form>--}}

{{--        </flux:menu>--}}
{{--    </flux:dropdown>--}}
{{--</flux:header>--}}

{{ $slot }}


    <livewire:global-modal />

    @livewireScripts
@fluxScripts
</body>
</html>
