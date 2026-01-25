<div class="max-w-[800px] bg-white p-10 md:p-14 rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 mx-auto">
    <div class="text-center mb-10">
        <h1 class="text-3xl font-extrabold tracking-tight mb-4">
            @if($isSocial)
                Complete seu <span class="text-primary">cadastro</span>
            @else
                Comece sua <span class="text-primary">jornada</span>
            @endif
        </h1>
        <p class="text-slate-500 font-medium">
            @if($isSocial)
                Estamos quase lá! Só precisamos de mais alguns dados fiscais.
            @else
                Crie sua conta gratuita e modernize sua gestão financeira em minutos.
            @endif
        </p>
    </div>
    
    <form wire:submit="register" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 ml-2">Nome Completo</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-slate-400">person</span>
                    <input wire:model="name" class="form-input-custom pl-14 @error('name') error @enderror" placeholder="Ex: João Silva" type="text"/>
                </div>
                @error('name') <span class="text-red-500 text-xs mt-1 ml-2 font-bold">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 ml-2">E-mail Corporativo</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-slate-400">mail</span>
                    <input wire:model="email" class="form-input-custom pl-14 @error('email') error @enderror" placeholder="seu@email.com.br" type="email" {{ $isSocial ? 'readonly' : '' }}/>
                </div>
                @error('email') <span class="text-red-500 text-xs mt-1 ml-2 font-bold">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 ml-2">CPF ou CNPJ</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-slate-400">badge</span>
                    <input wire:model="document" x-mask:dynamic="$input.length > 14 ? '99.999.999/9999-99' : '999.999.999-99'" class="form-input-custom pl-14 @error('document') error @enderror" placeholder="000.000.000-00" type="text"/>
                </div>
                @error('document') <span class="text-red-500 text-xs mt-1 ml-2 font-bold">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 ml-2">Telefone</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-slate-400">smartphone</span>
                    <input wire:model="phone" x-mask="(99) 99999-9999" class="form-input-custom pl-14 @error('phone') error @enderror" placeholder="(00) 00000-0000" type="text"/>
                </div>
                @error('phone') <span class="text-red-500 text-xs mt-1 ml-2 font-bold">{{ $message }}</span> @enderror
            </div>
        </div>

        @if(!$isSocial)
            <div x-data="{
                password: '',
                score: 0,
                checkStrength() {
                    this.score = 0;
                    if (this.password.length > 5) this.score++;
                    if (this.password.length > 8) this.score++;
                    if (/[A-Z]/.test(this.password)) this.score++;
                    if (/[0-9]/.test(this.password) || /[^A-Za-z0-9]/.test(this.password)) this.score++;
                }
            }">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2 ml-2">Senha de Acesso</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-slate-400">lock</span>
                            <input wire:model="password" x-model="password" @input="checkStrength()" class="form-input-custom pl-14 @error('password') error @enderror" placeholder="Mínimo 8 caracteres" type="password"/>
                        </div>
                        <div class="flex gap-1 h-1 mt-2 transition-all duration-300">
                            <div class="h-full rounded-full transition-all duration-300"
                                 :class="{
                                    'w-1/4 bg-red-500': score <= 1 && password.length > 0,
                                    'w-2/4 bg-orange-500': score === 2,
                                    'w-3/4 bg-yellow-500': score === 3,
                                    'w-full bg-green-500': score === 4,
                                    'bg-slate-200 w-full': password.length === 0
                                 }"></div>
                        </div>
                        @error('password') <span class="text-red-500 text-xs mt-1 ml-2 font-bold">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2 ml-2">Confirmar Senha</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-slate-400">lock_reset</span>
                            <input wire:model="password_confirmation" class="form-input-custom pl-14" placeholder="Confirme sua senha" type="password"/>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="flex items-start gap-3 py-2">
            <input wire:model="terms" class="mt-1 w-5 h-5 rounded border-slate-300 text-primary focus:ring-primary" id="terms" type="checkbox"/>
            <label class="text-sm text-slate-500 leading-relaxed font-medium" for="terms">
                Eu concordo com os <a class="text-primary font-bold hover:underline" href="#">Termos de Uso</a> e a <a class="text-primary font-bold hover:underline" href="#">Política de Privacidade</a>.
            </label>
            @error('terms') <span class="text-red-500 text-xs ml-2 font-bold">{{ $message }}</span> @enderror
        </div>

        <button class="w-full bg-primary hover:bg-blue-700 text-white py-5 rounded-full font-bold text-lg shadow-xl shadow-primary/30 transition-all transform hover:scale-[1.02] active:scale-[0.98] flex items-center justify-center gap-2" type="submit">
            <span wire:loading.remove>{{ $isSocial ? 'Finalizar Cadastro' : 'Criar Minha Conta' }}</span>
            <span wire:loading>Aguarde...</span>
            <span wire:loading.remove class="material-symbols-outlined">rocket_launch</span>
        </button>
    </form>

    @if(!$isSocial)
        <div class="relative flex items-center gap-4 my-8">
            <div class="grow border-t border-slate-100"></div>
            <span class="text-slate-400 text-xs font-bold uppercase tracking-widest">ou</span>
            <div class="grow border-t border-slate-100"></div>
        </div>

        <a href="{{ route('google.redirect') }}" class="w-full bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 py-4 rounded-2xl font-bold text-base transition-all transform hover:scale-[1.02] active:scale-[0.98] flex items-center justify-center gap-3">
            <svg height="20" viewBox="0 0 24 24" width="20" xmlns="http://www.w3.org/2000/svg">
                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"></path>
                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"></path>
                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"></path>
                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"></path>
            </svg>
            Registrar com Google
        </a>
    @endif
</div>
