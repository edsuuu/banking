<?php

namespace App\Livewire\Settings\Business;

use Livewire\Component;
use App\Models\Business;
use App\Models\Address;
use App\Services\AddressService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    // Business fields
    public $tax_id;
    public $company_type;
    public $legal_name;
    public $trading_name;

    // Address fields
    public $zip_code;
    public $street;
    public $number;
    public $complement;
    public $neighborhood;
    public $city;
    public $state;

    public $isEditing = false;

    public $states = [
        'AC' => 'Acre', 'AL' => 'Alagoas', 'AP' => 'Amapá', 'AM' => 'Amazonas', 'BA' => 'Bahia',
        'CE' => 'Ceará', 'DF' => 'Distrito Federal', 'ES' => 'Espírito Santo', 'GO' => 'Goiás',
        'MA' => 'Maranhão', 'MT' => 'Mato Grosso', 'MS' => 'Mato Grosso do Sul', 'MG' => 'Minas Gerais',
        'PA' => 'Pará', 'PB' => 'Paraíba', 'PR' => 'Paraná', 'PE' => 'Pernambuco', 'PI' => 'Piauí',
        'RJ' => 'Rio de Janeiro', 'RN' => 'Rio Grande do Norte', 'RS' => 'Rio Grande do Sul',
        'RO' => 'Rondônia', 'RR' => 'Roraima', 'SC' => 'Santa Catarina', 'SP' => 'São Paulo',
        'SE' => 'Sergipe', 'TO' => 'Tocantins'
    ];

    public function mount()
    {
        $user = Auth::user();
        $business = $user->business;

        if ($business) {
            $this->tax_id = $business->tax_id;
            $this->company_type = $business->company_type;
            $this->legal_name = $business->legal_name;
            $this->trading_name = $business->trading_name;

            $address = $business->primaryAddress;
            if ($address) {
                $this->zip_code = $address->zip_code;
                $this->street = $address->street;
                $this->number = $address->number;
                $this->complement = $address->complement;
                $this->neighborhood = $address->neighborhood;
                $this->city = $address->city;
                $this->state = $address->state;
            }
        }
    }

    public function updatedZipCode($value)
    {
        if (strlen(preg_replace('/[^0-9]/', '', $value)) === 8) {
            $addressService = new AddressService();
            $data = $addressService->handle($value);

            if ($data) {
                $this->street = $data['street'];
                $this->neighborhood = $data['neighborhood'];
                $this->city = $data['city'];
                $this->state = $data['state'];
            }
        }
    }

    public function toggleEdit()
    {
        $this->isEditing = !$this->isEditing;
    }

    public function cancel()
    {
        $this->mount();
        $this->isEditing = false;
    }

    public function save()
    {
        $this->validate();

        DB::beginTransaction();

        try {
            $user = Auth::user();
            
            $business = $user->business;
            
            $businessData = [
                'tax_id' => $this->tax_id,
                'company_type' => $this->company_type,
                'legal_name' => $this->legal_name,
                'trading_name' => $this->trading_name,
            ];

            if (!$business) {
                $business = Business::query()->create($businessData);
                $user->update(['business_id' => $business->id]);
            } else {
                $business->update($businessData);
            }

            $address = $business->primaryAddress;
            if (!$address) {
                Address::query()->create([
                    'business_id' => $business->id,
                    'zip_code' => $this->zip_code,
                    'street' => $this->street,
                    'number' => $this->number,
                    'complement' => $this->complement,
                    'neighborhood' => $this->neighborhood,
                    'city' => $this->city,
                    'state' => $this->state,
                    'is_primary' => true,
                ]);
            } else {
                $address->update([
                    'zip_code' => $this->zip_code,
                    'street' => $this->street,
                    'number' => $this->number,
                    'complement' => $this->complement,
                    'neighborhood' => $this->neighborhood,
                    'city' => $this->city,
                    'state' => $this->state,
                ]);
            }

            DB::commit();

            $this->isEditing = false;
            $this->dispatch('business-updated');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::channel('daily')->error('Business Update Error: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'exception' => $e
            ]);
            $this->addError('tax_id', 'Ocorreu um erro ao salvar as informações da empresa.');
        }
    }

    protected function rules()
    {
        return [
            'tax_id' => 'required|string|cnpj', // Restricted to CNPJ
            'legal_name' => 'required|string|max:255',
            'trading_name' => 'required|string|max:255',
            'zip_code' => 'required|string',
            'street' => 'required|string',
            'number' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string|size:2',
        ];
    }

    protected function messages()
    {
        return [
            'tax_id.cnpj' => 'O CNPJ informado é inválido.',
            'tax_id.required' => 'O CNPJ é obrigatório.',
        ];
    }

    protected function validationAttributes()
    {
        return [
            'tax_id' => 'CNPJ',
            'legal_name' => 'Razão Social',
            'trading_name' => 'Nome Fantasia',
            'zip_code' => 'CEP',
            'street' => 'Logradouro',
            'number' => 'Número',
            'city' => 'Cidade',
            'state' => 'Estado',
        ];
    }

    public function render()
    {
        return view('livewire.settings.business.index');
    }
}
