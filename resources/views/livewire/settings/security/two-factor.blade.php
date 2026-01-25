<div class="fixed inset-0 z-50 flex items-center justify-center p-4 modal-overlay">
    <div class="bg-white w-full max-w-xl rounded-5xl shadow-[0_32px_64px_-12px_rgba(29,78,216,0.15)] overflow-hidden border border-white">
        <div class="px-10 pt-10 pb-6 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-50 text-primary rounded-2xl flex items-center justify-center">
                    <span class="material-symbols-outlined fill-icon text-2xl">verified_user</span>
                </div>
                <div>
                    <h3 class="text-2xl font-extrabold text-slate-800">Ativar 2FA</h3>
                    <p class="text-sm text-slate-400 font-medium">Autenticação em duas etapas</p>
                </div>
            </div>
            <button wire:click="$parent.closeTwoFactorModal" class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-slate-100 transition-colors text-slate-400">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <div class="px-10 pb-10">
            <div class="space-y-8">
                <div class="bg-blue-50/50 rounded-4xl p-6 border border-blue-100/50">
                    <div class="flex gap-4">
                        <span class="material-symbols-outlined text-primary">info</span>
                        <p class="text-sm text-slate-600 leading-relaxed font-medium">
                            Use um aplicativo autenticador (como Google Authenticator ou Microsoft Authenticator) para escanear o código abaixo.
                        </p>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row items-center gap-10">
                    <div class="relative group">
                        <div class="absolute inset-0 bg-primary/5 rounded-4xl scale-110 blur-xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <div class="relative w-48 h-48 bg-white p-3 rounded-4xl border-2 border-slate-100 shadow-sm flex items-center justify-center">
                            <img alt="QR Code 2FA" class="w-full h-full object-contain rounded-2xl" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBB-H6EOHjSnWjVGsIjNr1bk8gQm-lAdgVlZgX3z72nwmF_AP1bHTcI-RlflVAxJokOQM8Qv07Kg4uXptkP6F4NoKlsUM8skxP8dZfTXQM1zK2PyLff34HTEJEYlojR1kh58VSl5qThvOtlkwGiQnO-2Xoedsg4Wk8OoWiiZDEyk4Mrue6_MEBfhg9GfgbqmPvkidjU-MQuOs5QUDNFuC6ti98wYP1txQNu-ZS6c5RAKBcAv7wsYXyjuCHxAV7woR2mgyXsEmRT2sc"/>
                        </div>
                    </div>
                    <div class="flex-1 space-y-4">
                        <div class="space-y-1">
                            <h4 class="text-sm font-bold text-slate-800">Chave de Configuração</h4>
                            <p class="text-xs text-slate-400 font-medium">Se não conseguir escanear, digite este código:</p>
                        </div>
                        <div class="flex items-center gap-2 p-3 bg-slate-50 border border-slate-100 rounded-2xl">
                            <code class="flex-1 text-sm font-black text-primary tracking-widest text-center">ABCD 1234 EFGH 5678</code>
                            <button class="p-2 hover:bg-white rounded-xl text-slate-400 hover:text-primary transition-all">
                                <span class="material-symbols-outlined text-lg">content_copy</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="space-y-4 pt-4 border-t border-slate-100">
                    <div>
                        <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Código de Verificação</label>
                        <p class="text-[11px] text-slate-400 font-medium mb-3">Insira o código de 6 dígitos gerado pelo seu app.</p>
                        <div class="flex gap-3 justify-between">
                            <input class="w-full h-14 bg-slate-50 border-slate-100 rounded-2xl text-center text-xl font-bold text-primary focus:ring-primary focus:border-primary focus:bg-white transition-all" maxlength="1" placeholder="-" type="text"/>
                            <input class="w-full h-14 bg-slate-50 border-slate-100 rounded-2xl text-center text-xl font-bold text-primary focus:ring-primary focus:border-primary focus:bg-white transition-all" maxlength="1" placeholder="-" type="text"/>
                            <input class="w-full h-14 bg-slate-50 border-slate-100 rounded-2xl text-center text-xl font-bold text-primary focus:ring-primary focus:border-primary focus:bg-white transition-all" maxlength="1" placeholder="-" type="text"/>
                            <input class="w-full h-14 bg-slate-50 border-slate-100 rounded-2xl text-center text-xl font-bold text-primary focus:ring-primary focus:border-primary focus:bg-white transition-all" maxlength="1" placeholder="-" type="text"/>
                            <input class="w-full h-14 bg-slate-50 border-slate-100 rounded-2xl text-center text-xl font-bold text-primary focus:ring-primary focus:border-primary focus:bg-white transition-all" maxlength="1" placeholder="-" type="text"/>
                            <input class="w-full h-14 bg-slate-50 border-slate-100 rounded-2xl text-center text-xl font-bold text-primary focus:ring-primary focus:border-primary focus:bg-white transition-all" maxlength="1" placeholder="-" type="text"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-10 flex gap-4">
                <button wire:click="$parent.closeTwoFactorModal" class="flex-1 py-4 text-sm font-bold text-slate-500 hover:bg-slate-50 rounded-pill transition-all">
                    Voltar
                </button>
                <button class="flex-[2] py-4 bg-primary text-white rounded-pill text-sm font-bold shadow-lg shadow-blue-500/25 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-sm">lock_open</span>
                    Concluir Ativação
                </button>
            </div>
        </div>
    </div>
</div>
