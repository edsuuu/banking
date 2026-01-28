<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-behavior: smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @fluxAppearance
</head>
<body>


<flux:header container class="sticky top-0 z-50 bg-white/70 backdrop-blur-xl border-b border-slate-100 flex items-center justify-between h-20 px-6">
    <div class="flex items-center gap-8">
        <a href="/" wire:navigate>
            <x-app-logo :name="config('app.name')"/>
        </a>

        <flux:navbar class="hidden md:flex items-center gap-6">
            <a class="text-sm font-semibold text-slate-500 hover:text-primary transition-colors" href="#features">Funcionalidades</a>
            <a class="text-sm font-semibold text-slate-500 hover:text-primary transition-colors" href="#how-it-works">Como Funciona</a>
            <a class="text-sm font-semibold text-slate-500 hover:text-primary transition-colors" href="#api">API</a>
        </flux:navbar>
    </div>

    <flux:spacer />

    <div class="flex items-center gap-4">
        @auth
            <flux:dropdown position="top" align="end">
                <flux:profile circle :name="auth()->user()->name" class="cursor-pointer !text-zinc-700"/>
                <flux:menu>
                    <flux:menu.item :href="route('dashboard')" wire:navigate icon="musical-note" class="cursor-pointer">Dashboard</flux:menu.item>
                    <flux:menu.separator />
                    
                        <flux:menu.radio.group>
                        <div class="px-1 py-1.5">
                            <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
                                <flux:radio value="light" icon="sun" class="cursor-pointer"/>
                                <flux:radio value="dark" icon="moon" class="cursor-pointer"/>
                                <flux:radio value="system" icon="computer-desktop" class="cursor-pointer"/>
                            </flux:radio.group>
                        </div>
                    </flux:menu.radio.group>
                    
                    <flux:menu.separator />
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <flux:menu.item type="submit" icon="arrow-right-start-on-rectangle" class="cursor-pointer">Sair</flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        @else
            <a href="{{ route('login') }}" class="hidden sm:block text-sm font-bold text-slate-700 hover:bg-slate-100 px-4 py-2 rounded-full transition-colors">
                Entrar
            </a>
            <a href="{{ route('register') }}" class="bg-primary hover:bg-blue-700 text-white px-6 py-2.5 rounded-full text-sm font-bold shadow-lg shadow-primary/20 transition-all transform hover:scale-105">
                Criar Conta Grátis
            </a>
        @endauth
    </div>
</flux:header>



{{--<flux:sidebar sticky collapsible="mobile" class="lg:hidden bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">--}}
{{--    <flux:sidebar.header>--}}
{{--        <flux:sidebar.brand--}}
{{--            href="#"--}}
{{--            logo="https://fluxui.dev/img/demo/dark-mode-logo.png"--}}
{{--            name="{{ config('app.name') }}"--}}
{{--        />--}}
{{--        <flux:sidebar.collapse class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2" />--}}
{{--    </flux:sidebar.header>--}}
{{--    <flux:sidebar.nav>--}}
{{--        <flux:sidebar.item icon="home" href="#" current>Home</flux:sidebar.item>--}}
{{--        <flux:sidebar.item icon="inbox" badge="12" href="#">Politica de privacidade</flux:sidebar.item>--}}
{{--    </flux:sidebar.nav>--}}
{{--    <flux:sidebar.spacer />--}}
{{--    <flux:sidebar.nav>--}}
{{--        <flux:sidebar.item icon="cog-6-tooth" href="#">Settings</flux:sidebar.item>--}}
{{--        <flux:sidebar.item icon="information-circle" href="#">Help</flux:sidebar.item>--}}
{{--    </flux:sidebar.nav>--}}
{{--</flux:sidebar>--}}

<flux:main>
    {{--    @livewire('sidebar')--}}
    {{ $slot }}

    <footer class="pt-10 text-center">
        <p class="text-slate-400 text-sm font-medium">© 2024 FinPay Pagamentos S.A. Todos os direitos reservados.</p>
        <div class="mt-4 flex justify-center items-center gap-6">
<span class="flex items-center gap-2 text-xs text-slate-400 font-medium">
<span class="w-2 h-2 bg-secondary rounded-full"></span>
                Status: Operacional
            </span>
            <a class="text-xs text-slate-400 hover:text-primary font-medium" href="#">Privacidade</a>
            <a class="text-xs text-slate-400 hover:text-primary font-medium" href="#">Termos</a>
        </div>
    </footer>
</flux:main>


@livewireScripts
@fluxScripts


</body>
</html>
