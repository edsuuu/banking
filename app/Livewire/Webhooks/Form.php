<?php

namespace App\Livewire\Webhooks;

use Livewire\Component;
use App\Models\BusinessWebhook;
use App\Models\WebhookEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Form extends Component
{
    public ?int $webhookId = null;
    public string $name = '';
    public string $url = '';
    public ?string $header_name = null;
    public ?string $header_value = null;
    public bool $is_active = true;
    public array $events = [];
    public string $secret_key = '';

    protected function rules(): array
    {
        return [
            'url' => 'required|url',
            'events' => 'required|array|min:1',
            'header_name' => 'nullable|string',
            'header_value' => 'nullable|string',
            'is_active' => 'boolean',
        ];
    }

    protected function messages(): array
    {
        return [
            'url.required' => 'A URL é obrigatória.',
            'url.url' => 'Informe uma URL válida.',
            'events.required' => 'Selecione pelo menos um evento.',
            'events.min' => 'Selecione pelo menos um evento.',
        ];
    }

    protected function validationAttributes(): array
    {
        return [
            'url' => 'URL de destino',
            'events' => 'eventos',
            'header_name' => 'chave do cabeçalho',
            'header_value' => 'valor do cabeçalho',
        ];
    }

    public function mount($webhookId = null): void
    {

        if ($webhookId) {
            $this->webhookId = $webhookId;
            $webhook = BusinessWebhook::where('business_id', Auth::user()->business_id)
                ->findOrFail($webhookId);

            $this->name = 'Editar Webhook';
            $this->url = $webhook->url;
            $this->header_name = $webhook->header_name;
            $this->header_value = $webhook->header_value;
            $this->is_active = (bool) $webhook->is_active;
            $this->secret_key = $webhook->secret_key;
            $this->events = $webhook->events->pluck('name')->toArray();
        } else {
            $this->name = 'Novo Webhook';
            $this->is_active = true;
            $this->secret_key = 'whsec_' . Str::random(32);
        }
    }

    public function toggleSelectAll(): void
    {
        $allEvents = WebhookEvent::all()->pluck('name')->toArray();
        if (count($this->events) === count($allEvents)) {
            $this->events = [];
        } else {
            $this->events = $allEvents;
        }
    }

    public function save(): void
    {
        $this->validate();

        DB::transaction(function () {
            $businessId = Auth::user()->business_id;

            $data = [
                'business_id' => $businessId,
                'url' => $this->url,
                'header_name' => $this->header_name,
                'header_value' => $this->header_value,
                'is_active' => $this->is_active,
                'secret_key' => $this->secret_key,
            ];

            if ($this->webhookId) {
                $webhook = BusinessWebhook::where('business_id', $businessId)->findOrFail($this->webhookId);
                $webhook->update(array_merge($data, [])); // secret_key typically doesn't change on edit unless regenerated, but logic above uses existing or new. Logic here is consistent with previous.
            } else {
                $data['public_key'] = 'pk_' . Str::random(24);
                $webhook = BusinessWebhook::create($data);
            }

            $eventIds = [];
            foreach ($this->events as $eventName) {
                $event = WebhookEvent::firstOrCreate(
                    ['name' => $eventName],
                    ['description' => 'Auto-generated event from UI']
                );
                $eventIds[] = $event->id;
            }

            $webhook->events()->sync($eventIds);
        });

        $this->dispatch($this->webhookId ? 'webhook-updated' : 'webhook-created');
        $this->dispatch('closeModal');
    }

    public function close(): void
    {
        $this->dispatch('closeModal');
    }

    public function render()
    {
        return view('livewire.webhooks.form', [
            'availableEvents' => WebhookEvent::all(),
        ]);
    }
}
