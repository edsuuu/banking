<?php

namespace App\Livewire\Products;

use Livewire\Component;

use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Illuminate\View\View;

class Index extends Component
{
    use WithPagination;

    public string $search = '';

    public function render(): View
    {
        $user = Auth::user();
        $products = Product::query()
            ->where('business_id', $user->business_id)
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('livewire.products.index', [
            'products' => $products
        ]);
    }
}
