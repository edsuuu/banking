<?php

namespace App\Livewire\Products;

use App\Models\Product;
use App\Models\Category;
use App\Services\S3Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Collection;

class Edit extends Component
{
    use WithFileUploads;

    public Product $product;

    public string $name = '';
    public string $category_id = '';
    public string $price = '';
    public string $payment_type = '';
    public string $description = '';
    public $image;
    public $newImage;
    public string $status = '';
    public Collection $categories;

    public function mount(string $id): void
    {
        $product = Product::query()->findOrFail($id);

        if ($product->business_id !== Auth::user()->business_id) {
            abort(403);
        }

        $this->product = $product;
        $this->name = $product->name;
        $this->category_id = (string) $product->category_id;
        $this->price = number_format((float) $product->price, 2, ',', '.');
        $this->payment_type = $product->payment_type;
        $this->description = $product->description ?? '';
        $this->image = $product->image_path;
        $this->status = $product->status;
        $this->categories = Category::query()
            ->where('business_id', Auth::user()->business_id)
            ->get();
    }

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|string',
            'payment_type' => 'required|in:single,subscription',
            'description' => 'nullable|string',
            'newImage' => 'nullable|image|max:5120',
            'status' => 'required|in:active,paused',
        ];
    }

    protected function messages(): array
    {
        return [
            'name.required' => 'O nome do produto é obrigatório.',
            'category_id.required' => 'Selecione uma categoria.',
            'price.required' => 'O preço é obrigatório.',
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
            'newImage' => 'nova imagem',
            'status' => 'status',
        ];
    }

    public function submit(S3Service $s3Service): RedirectResponse
    {
        $this->validate();

        $price = $this->parseCurrency($this->price);
        
        $data = [
            'name' => $this->name,
            'category_id' => $this->category_id,
            'price' => $price,
            'payment_type' => $this->payment_type,
            'description' => $this->description,
            'status' => $this->status,
        ];

        if ($this->newImage) {
            if ($this->product->image) {
                $s3Service->deleteFile($this->product->image->path);
                $this->product->image()->delete();
            }
            $s3Service->upload($this->newImage, $this->product, 'products');
        }

        $this->product->update($data);

        return redirect()->route('products.index');
    }

    public function delete(): RedirectResponse
    {
        $this->product->delete();
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
        return view('livewire.products.edit');
    }
}
