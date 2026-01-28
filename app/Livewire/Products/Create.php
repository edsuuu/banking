<?php

namespace App\Livewire\Products;

use App\Models\Product;
use App\Models\Category;
use App\Services\S3Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Http\RedirectResponse;

class Create extends Component
{
    use WithFileUploads;

    public string $name = '';
    public string $category_id = '';
    public string $price = '';
    public string $payment_type = 'single';
    public string $description = '';
    public $image;
    
    protected $listeners = ['category-created' => '$refresh'];

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|string',
            'payment_type' => 'required|in:single,subscription',
            'description' => 'nullable|string',
            'image' => 'required|image|max:5120',
        ];
    }

    protected function messages(): array
    {
        return [
            'name.required' => 'O nome do produto é obrigatório.',
            'category_id.required' => 'Selecione uma categoria.',
            'price.required' => 'O preço é obrigatório.',
            'image.required' => 'A imagem do produto é obrigatória.',
        ];
    }

    protected function validationAttributes(): array
    {
        return [
            'name' => 'nome do produto',
            'category_id' => 'categoria',
            'price' => 'preço',
            'payment_type' => 'tipo de pagamento',
            'description' => 'descrição',
            'image' => 'imagem',
        ];
    }

    public function submit(S3Service $s3Service): RedirectResponse
    {
        $this->validate();

        $price = $this->parseCurrency($this->price);

        DB::transaction(function () use ($s3Service, $price) {
            $product = Product::query()->create([
                'business_id' => Auth::user()->business_id,
                'name' => $this->name,
                'category_id' => $this->category_id,
                'price' => $price,
                'payment_type' => $this->payment_type,
                'description' => $this->description,
                'image_path' => '',
                'status' => 'active',
            ]);

            $s3Service->upload($this->image, $product, 'products');
        });

        return redirect()->route('products.index');
    }

    protected function parseCurrency(string $value): float
    {
        if (!$value) return 0.0;
        $value = preg_replace('/[^0-9,]/', '', $value);
        $value = str_replace(',', '.', $value);
        return (float) $value;
    }

    public function render(): View
    {
        $categories = Category::query()
            ->where('business_id', Auth::user()->business_id)
            ->get();
        
        if ($categories->isEmpty()) {
            session()->flash('error', 'Você precisa cadastrar uma categoria antes de criar um produto.');
        }

        return view('livewire.products.create', [
            'categories' => $categories
        ]);
    }
}
