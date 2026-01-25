@props(['name'])

<div {{ $attributes->merge(['class' => 'flex items-center gap-2']) }}>
    <div class="w-10 h-10 bg-gradient-to-tr from-primary to-secondary rounded-xl flex items-center justify-center shadow-lg shadow-primary/20">
        <span class="material-symbols-outlined text-white">payments</span>
    </div>
    <span class="text-2xl font-extrabold tracking-tight">Fin<span class="text-primary">Pay</span></span>
</div>
