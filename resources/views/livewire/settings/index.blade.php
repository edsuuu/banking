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
                    <button class="px-6 py-4 text-sm font-bold tab-active whitespace-nowrap">Perfil Pessoal</button>
                    <button
                        class="px-6 py-4 text-sm font-bold text-slate-400 hover:text-primary transition-colors whitespace-nowrap">
                        Dados do Negócio
                    </button>
                    <button
                        class="px-6 py-4 text-sm font-bold text-slate-400 hover:text-primary transition-colors whitespace-nowrap">
                        Segurança &amp; Senha
                    </button>
                    <button
                        class="px-6 py-4 text-sm font-bold text-slate-400 hover:text-primary transition-colors whitespace-nowrap">
                        Notificações
                    </button>
                    <button
                        class="px-6 py-4 text-sm font-bold text-slate-400 hover:text-primary transition-colors whitespace-nowrap">
                        Planos
                    </button>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                    <div class="lg:col-span-8 space-y-8">
                        <section
                            class="bg-slate-50 rounded-4xl p-8 border border-transparent hover:border-blue-100 transition-all">
                            <div class="flex items-center gap-4 mb-8">
                                <div class="relative">
                                    <div
                                        class="w-20 h-20 rounded-3xl gradient-blue flex items-center justify-center text-white text-2xl font-black shadow-lg shadow-blue-500/30">
                                        JS
                                    </div>
                                    <button
                                        class="absolute -bottom-2 -right-2 w-8 h-8 bg-white rounded-xl shadow-md flex items-center justify-center text-primary border border-slate-100 hover:bg-slate-50 transition-all">
                                        <span class="material-symbols-outlined text-lg">edit</span>
                                    </button>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-slate-800">Foto de Perfil</h3>
                                    <p class="text-xs text-slate-400 font-medium mt-1">PNG ou JPG até 5MB. Recomendado
                                        400x400px.</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Nome
                                        Completo</label>
                                    <input
                                        class="w-full bg-white border-slate-100 rounded-2xl px-5 py-3.5 text-sm font-semibold text-slate-700 focus:ring-primary focus:border-primary transition-all"
                                        type="text" value="João Silva de Oliveira"/>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">E-mail
                                        Principal</label>
                                    <input
                                        class="w-full bg-white border-slate-100 rounded-2xl px-5 py-3.5 text-sm font-semibold text-slate-700 focus:ring-primary focus:border-primary transition-all"
                                        type="email" value="joao.silva@empresa.com.br"/>
                                </div>
                                <div class="space-y-2">
                                    <label
                                        class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">CPF</label>
                                    <input
                                        class="w-full bg-white border-slate-100 rounded-2xl px-5 py-3.5 text-sm font-semibold text-slate-700 focus:ring-primary focus:border-primary transition-all"
                                        type="text" value="000.000.000-00"/>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Telefone
                                        / WhatsApp</label>
                                    <input
                                        class="w-full bg-white border-slate-100 rounded-2xl px-5 py-3.5 text-sm font-semibold text-slate-700 focus:ring-primary focus:border-primary transition-all"
                                        type="text" value="(11) 99999-9999"/>
                                </div>
                            </div>
                        </section>
                        <section
                            class="bg-slate-50 rounded-4xl p-8 border border-transparent hover:border-blue-100 transition-all">
                            <div class="flex items-center justify-between mb-8">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 bg-blue-100 text-primary rounded-xl flex items-center justify-center">
                                        <span class="material-symbols-outlined">business</span>
                                    </div>
                                    <h3 class="text-xl font-bold text-slate-800">Dados da Empresa</h3>
                                </div>
                                <span
                                    class="text-[10px] font-bold text-blue-500 bg-blue-50 px-3 py-1 rounded-full uppercase">CNPJ Ativo</span>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Razão
                                        Social</label>
                                    <input
                                        class="w-full bg-white border-slate-100 rounded-2xl px-5 py-3.5 text-sm font-semibold text-slate-700 focus:ring-primary focus:border-primary transition-all"
                                        type="text" value="João Silva Tecnologia e Soluções LTDA"/>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Nome
                                        Fantasia</label>
                                    <input
                                        class="w-full bg-white border-slate-100 rounded-2xl px-5 py-3.5 text-sm font-semibold text-slate-700 focus:ring-primary focus:border-primary transition-all"
                                        type="text" value="JS Tech"/>
                                </div>
                                <div class="space-y-2 md:col-span-2">
                                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Endereço
                                        Fiscal</label>
                                    <input
                                        class="w-full bg-white border-slate-100 rounded-2xl px-5 py-3.5 text-sm font-semibold text-slate-700 focus:ring-primary focus:border-primary transition-all"
                                        type="text" value="Av. Paulista, 1000 - Bela Vista, São Paulo - SP"/>
                                </div>
                            </div>
                        </section>
                        <div class="flex justify-end gap-4 pb-8">
                            <button
                                class="px-8 py-4 text-sm font-bold text-slate-500 hover:bg-slate-50 rounded-pill transition-all">
                                Cancelar
                            </button>
                            <button
                                class="px-10 py-4 bg-primary text-white rounded-pill text-sm font-bold shadow-lg shadow-blue-500/20 hover:scale-[1.02] transition-all">
                                Salvar Alterações
                            </button>
                        </div>
                    </div>
                    <div class="lg:col-span-4 space-y-8">
                        <div class="bg-blue-50/50 rounded-5xl p-8 border border-blue-100 text-center shadow-sm">
                            <div
                                class="w-16 h-16 bg-white rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-md shadow-blue-500/5">
                                <span class="material-symbols-outlined text-primary text-3xl fill-icon">shield</span>
                            </div>
                            <h3 class="text-xl font-bold mb-2 text-slate-800 leading-tight">Segurança</h3>
                            <p class="text-xs text-slate-400 font-medium mb-8">Proteja seu acesso e suas transações.</p>
                            <div class="space-y-3">
                                <button
                                    class="w-full py-4 bg-white rounded-pill text-xs font-bold shadow-sm border border-slate-100 hover:border-primary hover:text-primary transition-all flex items-center px-6 gap-4 group">
                                    <span
                                        class="material-symbols-outlined text-primary text-lg group-hover:scale-110 transition-transform">password</span>
                                    <span>Alterar Senha</span>
                                </button>
                                <button
                                    class="w-full py-4 bg-white rounded-pill text-xs font-bold shadow-sm border border-slate-100 hover:border-primary hover:text-primary transition-all flex items-center px-6 gap-4 group">
                                    <span
                                        class="material-symbols-outlined text-primary text-lg group-hover:scale-110 transition-transform">vibration</span>
                                    <span>Ativar 2FA</span>
                                </button>
                                <button
                                    class="w-full py-4 bg-white rounded-pill text-xs font-bold shadow-sm border border-slate-100 hover:border-primary hover:text-primary transition-all flex items-center px-6 gap-4 group">
                                    <span
                                        class="material-symbols-outlined text-primary text-lg group-hover:scale-110 transition-transform">devices</span>
                                    <span>Sessões Ativas</span>
                                </button>
                            </div>
                        </div>
                        <div
                            class="bg-gradient-to-br from-primary to-blue-400 rounded-5xl p-8 text-white relative overflow-hidden group">
                            <div class="relative z-10">
                                <div
                                    class="bg-white/20 text-white px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-wider w-fit mb-4">
                                    Conta Premium
                                </div>
                                <h4 class="text-xl font-bold mb-2">FinPay Plus</h4>
                                <p class="text-xs text-white/80 mb-6 leading-relaxed">Você está aproveitando o melhor
                                    que a nossa plataforma oferece.</p>
                                <div class="flex items-center gap-2 mb-4">
                                    <span class="material-symbols-outlined text-sm">check_circle</span>
                                    <span class="text-[10px] font-bold">Taxa reduzida (1.5%)</span>
                                </div>
                                <button
                                    class="bg-white/20 backdrop-blur-md text-white px-6 py-3 rounded-pill font-bold text-xs w-full hover:bg-white/30 transition-all">
                                    Gerenciar Plano
                                </button>
                            </div>
                            <span
                                class="material-symbols-outlined absolute -bottom-6 -right-6 text-[10rem] text-white/10 rotate-12 group-hover:scale-110 transition-transform pointer-events-none">auto_awesome</span>
                        </div>
                        <div class="bg-red-50 rounded-4xl p-8 border border-red-100">
                            <h4 class="text-sm font-bold text-red-600 mb-2">Área de Perigo</h4>
                            <p class="text-[10px] text-red-400 font-medium mb-6">Ao encerrar sua conta, todos os seus
                                dados serão permanentemente removidos de nossos servidores.</p>
                            <button
                                class="w-full py-3 text-[10px] font-extrabold text-red-600 border border-red-200 rounded-pill hover:bg-red-600 hover:text-white transition-all uppercase tracking-widest">
                                Encerrar Minha Conta
                            </button>
                        </div>
                        <div class="px-6 text-center">
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">© 2024 FinPay
                                Blue</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</div>
