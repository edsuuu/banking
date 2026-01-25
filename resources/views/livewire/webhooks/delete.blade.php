<div class=" inset-0 z-50 flex items-center justify-center modal-overlay px-4">
    <div class="bg-white w-full max-w-md rounded-5xl shadow-2xl p-10 flex flex-col items-center text-center border border-slate-100">
        <div class="w-20 h-20 bg-red-50 rounded-3xl flex items-center justify-center text-danger mb-6">
            <span class="material-symbols-outlined text-4xl font-bold">delete_forever</span>
        </div>
        <h3 class="text-2xl font-extrabold text-slate-800 mb-2">Apagar Webhook</h3>
        <p class="text-slate-500 font-medium mb-8">Tem certeza que deseja apagar este webhook? Esta ação não poderá ser desfeita e as notificações cessarão imediatamente.</p>
        <div class="flex flex-col w-full gap-3">
            <button  wire:click="delete" class="w-full py-4 bg-red-500 text-white rounded-pill font-bold shadow-lg shadow-red-500/20 hover:bg-red-600 transition-all text-sm">
                Confirmar e Apagar
            </button>
            <button wire:click="$dispatch('closeModal')" class="w-full py-4 bg-slate-100 text-slate-600 rounded-pill font-bold hover:bg-slate-200 transition-all text-sm">
                Voltar
            </button>
        </div>
    </div>
</div>
