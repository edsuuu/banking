<?php

namespace App\Livewire\Products;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;
use Illuminate\View\View;

class CategoryModal extends ModalComponent
{
    public string $name = '';
    public string $type = 'product';

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'type' => 'required|in:product,service',
        ];
    }

    protected function messages(): array
    {
        return [
            'name.required' => 'O nome da categoria é obrigatório.',
            'type.required' => 'O tipo da categoria é obrigatório.',
        ];
    }

    protected function validationAttributes(): array
    {
        return [
            'name' => 'nome',
            'type' => 'tipo',
        ];
    }

    public function save(): void
    {
        $this->validate();

        Category::query()->create([
            'business_id' => Auth::user()->business_id,
            'name' => $this->name,
            'type' => $this->type,
        ]);

        $this->closeModal();
        $this->dispatch('category-created');
    }

    public function render(): View
    {
        return view('livewire.products.category-modal');
    }
    
    public static function modalMaxWidth(): string
    {
        return 'md';
    }
}
