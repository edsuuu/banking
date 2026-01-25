<div>
{{--    <!DOCTYPE html>--}}
{{--    <html lang="pt-br"><head>--}}
{{--        <meta charset="utf-8"/>--}}
{{--        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>--}}
{{--        <title>FinPay - Webhooks</title>--}}
{{--        <link href="https://fonts.googleapis.com" rel="preconnect"/>--}}
{{--        <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>--}}
{{--        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&amp;display=swap" rel="stylesheet"/>--}}
{{--        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>--}}
{{--        <script src="https://cdn.tailwindcss.com?plugins=forms,typography,container-queries"></script>--}}
{{--        <script>--}}
{{--            tailwind.config = {--}}
{{--                darkMode: "class",--}}
{{--                theme: {--}}
{{--                    extend: {--}}
{{--                        colors: {--}}
{{--                            primary: "#1d4ed8",--}}
{{--                            secondary: "#3b82f6",--}}
{{--                            accent: "#eff6ff",--}}
{{--                            dark: "#0f172a",--}}
{{--                            "background-light": "#f0f4f8",--}}
{{--                            "card-light": "#ffffff",--}}
{{--                        },--}}
{{--                        fontFamily: {--}}
{{--                            sans: ["'Plus Jakarta Sans'", "sans-serif"],--}}
{{--                        },--}}
{{--                        borderRadius: {--}}
{{--                            'xl': '1.5rem',--}}
{{--                            '2xl': '2rem',--}}
{{--                            '3xl': '3rem',--}}
{{--                            '4xl': '3.5rem',--}}
{{--                            '5xl': '4.5rem',--}}
{{--                            'pill': '100px',--}}
{{--                        },--}}
{{--                    },--}}
{{--                },--}}
{{--            };--}}
{{--        </script>--}}
{{--        <style type="text/tailwindcss">--}}
{{--            @layer base {--}}
{{--                body {--}}
{{--                    @apply bg-background-light text-slate-900 transition-colors duration-200;--}}
{{--                    font-family: 'Plus Jakarta Sans', sans-serif;--}}
{{--                }--}}
{{--            }--}}
{{--            .sidebar-item-active {--}}
{{--                @apply bg-primary text-white font-semibold;--}}
{{--            }--}}
{{--            ::-webkit-scrollbar {--}}
{{--                width: 6px;--}}
{{--            }--}}
{{--            ::-webkit-scrollbar-track {--}}
{{--                background: transparent;--}}
{{--            }--}}
{{--            ::-webkit-scrollbar-thumb {--}}
{{--                background: #cbd5e1;--}}
{{--                border-radius: 10px;--}}
{{--            }--}}
{{--            .main-container-rounded {--}}
{{--                border-radius: 4.5rem;--}}
{{--            }--}}
{{--            .material-symbols-outlined {--}}
{{--                font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;--}}
{{--            }--}}
{{--            .fill-icon {--}}
{{--                font-variation-settings: 'FILL' 1;--}}
{{--            }--}}
{{--            .gradient-blue {--}}
{{--                background: linear-gradient(135deg, #1d4ed8 0%, #3b82f6 100%);--}}
{{--            }--}}
{{--            .custom-scrollbar::-webkit-scrollbar {--}}
{{--                width: 4px;--}}
{{--            }--}}
{{--        </style>--}}
{{--    </head>--}}
    <div class="w-full mx-auto flex overflow-hidden gap-4 px-4">
        <main class="flex-1 flex flex-col bg-white main-container-rounded shadow-[0_10px_40px_rgba(0,0,0,0.04)] overflow-hidden border border-slate-100">
            <header class="h-24 flex items-center justify-between px-12 border-b border-slate-50 shrink-0">
                <div class="flex items-center gap-3 text-sm font-medium">
                    <span class="material-symbols-outlined text-primary text-xl">webhook</span>
                    <span class="text-slate-900 font-bold">Integrações / Webhooks</span>
                </div>
                <div class="flex items-center gap-4">
                    <button class="w-11 h-11 flex items-center justify-center text-slate-400 hover:bg-slate-50 rounded-full transition-all relative">
                        <span class="material-symbols-outlined text-xl">notifications</span>
                        <span class="absolute top-3.5 right-3.5 w-1.5 h-1.5 bg-blue-600 rounded-full border border-white"></span>
                    </button>
                    <button class="flex items-center gap-2 px-4 py-2 bg-blue-50 text-primary rounded-full font-bold text-xs hover:bg-blue-100 transition-all">
                        <span class="material-symbols-outlined text-sm fill-icon">verified_user</span>
                        Conta Verificada
                    </button>
                </div>
            </header>
            <div class="flex-1 overflow-y-auto p-12 custom-scrollbar">
                <div class="flex justify-between items-end mb-10">
                    <div>
                        <h2 class="text-3xl font-extrabold tracking-tight text-slate-800">Webhooks</h2>
                        <p class="text-slate-400 mt-1 font-medium">Gerencie o recebimento de notificações em tempo real para sua aplicação.</p>
                    </div>
                    <button wire:click="$dispatch('openModal', { component: 'webhooks.create' })" class="flex items-center gap-2 px-8 py-4 bg-primary text-white rounded-pill font-bold shadow-lg shadow-blue-500/30 hover:scale-105 transition-all text-sm">
                        <span class="material-symbols-outlined text-lg">add</span>
                        Novo Webhook
                    </button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                    <div class="bg-white border-2 border-slate-50 rounded-4xl p-8 flex flex-col gap-2 hover:border-blue-100 transition-all shadow-sm">
                        <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-primary mb-2">
                            <span class="material-symbols-outlined font-bold">check_circle</span>
                        </div>
                        <p class="text-xs font-bold uppercase tracking-widest text-slate-400">Total de Webhooks</p>
                        <h3 class="text-3xl font-black text-slate-800 tracking-tight">08</h3>
                    </div>
                    <div class="bg-white border-2 border-slate-50 rounded-4xl p-8 flex flex-col gap-2 hover:border-blue-100 transition-all shadow-sm">
                        <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-primary mb-2">
                            <span class="material-symbols-outlined font-bold">bolt</span>
                        </div>
                        <p class="text-xs font-bold uppercase tracking-widest text-slate-400">Eventos (24h)</p>
                        <h3 class="text-3xl font-black text-slate-800 tracking-tight">1.240</h3>
                    </div>
                    <div class="bg-white border-2 border-slate-50 rounded-4xl p-8 flex flex-col gap-2 hover:border-blue-100 transition-all shadow-sm">
                        <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-primary mb-2">
                            <span class="material-symbols-outlined font-bold">verified</span>
                        </div>
                        <p class="text-xs font-bold uppercase tracking-widest text-slate-400">Taxa de Sucesso</p>
                        <h3 class="text-3xl font-black text-slate-800 tracking-tight">99.8%</h3>
                    </div>
                </div>
                <div class="space-y-6">
                    <div class="flex items-center justify-between px-6">
                        <h4 class="text-lg font-bold text-slate-800">Endpoints Ativos</h4>
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Status: Online</span>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="bg-slate-50 rounded-4xl p-8 border border-transparent hover:border-blue-200 transition-all group">
                            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                                <div class="space-y-3 flex-1">
                                    <div class="flex items-center gap-3">
                                        <div class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-[10px] font-bold uppercase tracking-wider">Ativo</div>
                                        <span class="text-sm font-bold text-slate-800">Produção - API Principal</span>
                                    </div>
                                    <div class="flex items-center gap-2 bg-white px-4 py-2 rounded-2xl border border-slate-100 w-fit">
                                        <code class="text-sm font-semibold text-primary">https://api.meusistema.com.br/webhooks/finpay</code>
                                        <button class="material-symbols-outlined text-slate-400 hover:text-primary text-lg transition-colors">content_copy</button>
                                    </div>
                                    <div class="flex flex-wrap gap-2 pt-2">
                                        <span class="px-2 py-1 bg-blue-50 text-blue-600 rounded-lg text-[10px] font-bold">charge.created</span>
                                        <span class="px-2 py-1 bg-blue-50 text-blue-600 rounded-lg text-[10px] font-bold">charge.paid</span>
                                        <span class="px-2 py-1 bg-blue-50 text-blue-600 rounded-lg text-[10px] font-bold">refund.success</span>
                                        <span class="px-2 py-1 bg-slate-200 text-slate-500 rounded-lg text-[10px] font-bold">+2 mais</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-6 shrink-0 lg:border-l lg:border-slate-200 lg:pl-12">
                                    <div class="text-center">
                                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Último envio</p>
                                        <p class="text-xs font-bold text-slate-800">há 2 min</p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button wire:click="$dispatch('openModal', { component: 'webhooks.edit', params: { id: 1 } })" class="w-10 h-10 rounded-full bg-white border border-slate-100 flex items-center justify-center text-slate-500 hover:text-primary hover:border-primary transition-all shadow-sm">
                                            <span class="material-symbols-outlined text-xl">settings</span>
                                        </button>
                                        <button wire:click="$dispatch('openModal', { component: 'webhooks.delete', params: { id: 1 } })" class="w-10 h-10 rounded-full bg-white border border-slate-100 flex items-center justify-center text-red-400 hover:bg-red-50 hover:border-red-200 transition-all shadow-sm">
                                            <span class="material-symbols-outlined text-xl">delete</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-slate-50 rounded-4xl p-8 border border-transparent hover:border-blue-200 transition-all group">
                            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                                <div class="space-y-3 flex-1">
                                    <div class="flex items-center gap-3">
                                        <div class="px-3 py-1 bg-yellow-100 text-yellow-600 rounded-full text-[10px] font-bold uppercase tracking-wider">Testes</div>
                                        <span class="text-sm font-bold text-slate-800">Sandbox Integration</span>
                                    </div>
                                    <div class="flex items-center gap-2 bg-white px-4 py-2 rounded-2xl border border-slate-100 w-fit">
                                        <code class="text-sm font-semibold text-primary">https://stg-api.meusistema.com.br/hooks</code>
                                        <button class="material-symbols-outlined text-slate-400 hover:text-primary text-lg transition-colors">content_copy</button>
                                    </div>
                                    <div class="flex flex-wrap gap-2 pt-2">
                                        <span class="px-2 py-1 bg-blue-50 text-blue-600 rounded-lg text-[10px] font-bold">all_events</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-6 shrink-0 lg:border-l lg:border-slate-200 lg:pl-12">
                                    <div class="text-center">
                                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Último envio</p>
                                        <p class="text-xs font-bold text-slate-800">Ontem, 14:00</p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button wire:click="$dispatch('openModal', { component: 'webhooks.edit', params: { id: 2 } })" class="w-10 h-10 rounded-full bg-white border border-slate-100 flex items-center justify-center text-slate-500 hover:text-primary hover:border-primary transition-all shadow-sm">
                                            <span class="material-symbols-outlined text-xl">settings</span>
                                        </button>
                                        <button wire:click="$dispatch('openModal', { component: 'webhooks.delete', params: { id: 2 } })" class="w-10 h-10 rounded-full bg-white border border-slate-100 flex items-center justify-center text-red-400 hover:bg-red-50 hover:border-red-200 transition-all shadow-sm">
                                            <span class="material-symbols-outlined text-xl">delete</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-12 p-8 bg-blue-50/50 rounded-5xl border border-blue-100 flex items-center justify-between">
                    <div class="flex items-center gap-6">
                        <div class="w-16 h-16 bg-white rounded-3xl flex items-center justify-center text-primary shadow-sm border border-blue-50">
                            <span class="material-symbols-outlined text-3xl fill-icon">terminal</span>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-slate-800">Documentação Técnica</h4>
                            <p class="text-sm text-slate-500">Aprenda como validar assinaturas de webhooks para máxima segurança.</p>
                        </div>
                    </div>
                    <button class="px-6 py-3 bg-white border border-blue-100 rounded-pill text-xs font-bold text-primary hover:bg-primary hover:text-white transition-all shadow-sm">
                        Acessar Docs
                    </button>
                </div>
            </div>
        </main>
    </div>

</div>
