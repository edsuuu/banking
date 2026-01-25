<div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach($plans as $plan)
            @php
                $isPlus = $plan->slug === 'finpay-plus';
                $isCurrent = $currentPlanId == $plan->id;
            @endphp

            @if($isPlus)
                <div class="gradient-blue rounded-4xl p-10 flex flex-col text-white relative overflow-hidden card-plan-shadow shadow-blue-500/20 transform scale-105 z-10">
                    <div class="absolute top-8 right-8">
                        <span class="bg-white/20 backdrop-blur-md px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-wider">Mais Popular</span>
                    </div>
                    <div class="mb-8 relative z-10">
                        <div class="w-14 h-14 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center mb-6">
                            <span class="material-symbols-outlined text-white text-3xl fill-icon">auto_awesome</span>
                        </div>
                        <h3 class="text-2xl font-bold mb-2">{{ $plan->name }}</h3>
                        <p class="text-sm text-white/80 font-medium">{{ $plan->description }}</p>
                    </div>
                    <div class="mb-10 relative z-10">
                        <div class="flex items-baseline gap-1">
                            <span class="text-4xl font-extrabold">R$ {{ number_format($plan->price, 0, ',', '.') }}</span>
                            <span class="text-white/70 text-sm font-bold">/mês</span>
                        </div>
                        <p class="text-[10px] text-white/70 font-bold uppercase tracking-widest mt-2">Melhor Custo Benefício</p>
                    </div>
                    <ul class="space-y-4 mb-10 flex-1 relative z-10">
                        @foreach($plan->features as $feature)
                            <li class="flex items-center gap-3 text-sm font-medium">
                                <span class="material-symbols-outlined text-white text-lg">check_circle</span>
                                {{ $feature }}
                            </li>
                        @endforeach
                    </ul>
                    <button class="w-full py-4 bg-white {{ $isCurrent ? 'text-slate-400 cursor-not-allowed' : 'text-primary hover:scale-[1.03]' }} rounded-pill text-sm font-extrabold shadow-xl transition-all relative z-10">
                        {{ $isCurrent ? 'Plano Atual' : 'Migrar para este Plano' }}
                    </button>
                    <span class="material-symbols-outlined absolute -bottom-10 -right-10 text-[14rem] text-white/10 rotate-12 pointer-events-none">stars</span>
                </div>
            @else
                <div class="bg-slate-50 rounded-4xl p-10 flex flex-col border border-transparent hover:border-blue-100 transition-all card-plan-shadow">
                    <div class="mb-8">
                        <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center mb-6 shadow-sm">
                            <span class="material-symbols-outlined text-slate-400 text-3xl">
                                {{ $plan->slug === 'starter' ? 'rocket_launch' : 'corporate_fare' }}
                            </span>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-800 mb-2">{{ $plan->name }}</h3>
                        <p class="text-sm text-slate-400 font-medium">{{ $plan->description }}</p>
                    </div>
                    <div class="mb-10">
                        @if($plan->slug === 'enterprise')
                            <div class="flex items-baseline gap-1">
                                <span class="text-3xl font-extrabold text-slate-800">Custom</span>
                            </div>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-2">Sob Consulta</p>
                        @else
                            <div class="flex items-baseline gap-1">
                                <span class="text-3xl font-extrabold text-slate-800">R$ {{ number_format($plan->price, 0, ',', '.') }}</span>
                                <span class="text-slate-400 text-sm font-bold">/mês</span>
                            </div>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-2">Plano Inicial</p>
                        @endif
                    </div>
                    <ul class="space-y-4 mb-10 flex-1">
                        @foreach($plan->features as $feature)
                            <li class="flex items-center gap-3 text-sm text-slate-600 font-medium">
                                <span class="material-symbols-outlined text-blue-500 text-lg">check_circle</span>
                                {{ $feature }}
                            </li>
                        @endforeach
                    </ul>
                    @if($plan->slug === 'enterprise')
                        <button class="w-full py-4 bg-primary text-white rounded-pill text-sm font-bold shadow-lg shadow-blue-500/20 hover:scale-[1.02] transition-all">
                            Falar com Consultor
                        </button>
                    @else
                        <button class="w-full py-4 {{ $isCurrent ? 'bg-white border border-slate-200 text-slate-400' : 'bg-primary text-white hover:scale-[1.02]' }} rounded-pill text-sm font-bold transition-all">
                            {{ $isCurrent ? 'Plano Atual' : 'Migrar para este Plano' }}
                        </button>
                    @endif
                </div>
            @endif
        @endforeach
    </div>
    
    <div class="mt-16 bg-blue-50/50 rounded-5xl p-10 border border-blue-100/50">
        <div class="flex flex-col md:flex-row items-center gap-8">
            <div class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center shrink-0 shadow-sm border border-blue-50">
                <span class="material-symbols-outlined text-primary text-4xl">receipt_long</span>
            </div>
            <div class="flex-1 text-center md:text-left">
                <h4 class="text-xl font-bold text-slate-800 mb-1">Histórico de Faturamento</h4>
                <p class="text-sm text-slate-400 font-medium">Acesse suas faturas anteriores e comprovantes de pagamento.</p>
            </div>
            <button class="px-8 py-4 bg-white text-primary border border-blue-100 rounded-pill text-sm font-bold hover:bg-blue-50 transition-all flex items-center gap-2">
                Ver Faturas
                <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </button>
        </div>
    </div>
    <div class="mt-8 px-6 text-center">
        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">© 2024 FinPay Blue</p>
    </div>
</div>
