<?php

namespace App\Livewire\Settings;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Component;

class Notifications extends Component
{
    public array $settings = [];
    public bool $isThrottled = false;

    protected $rules = [
        'settings.*' => 'boolean',
    ];

    public function mount()
    {
        $business = Auth::user()->business;

        // Initialize with default values or existing settings
        $defaults = [
            'sales_enabled' => true,
            'customers_enabled' => true,
            'withdrawals_enabled' => true,
            'updates_enabled' => false,
            'channel_email' => true,
            'channel_push' => true,
            'channel_whatsapp' => false,
        ];

        $this->settings = array_merge($defaults, $business->notification_settings ?? []);
    }

    public function updatedSettings($value, $key)
    {
        $business = Auth::user()->business;
        // Chave específica por campo para detectar cliques repetidos no mesmo item
        $throttleKey = 'toggle-notifications-' . $business->id . '-' . $key;

        // Limite de 5 cliques por campo a cada 20 segundos
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $this->isThrottled = true;

            // Reverte o estado visual buscando do banco
            $this->settings = array_merge($this->settings, $business->notification_settings ?? []);

            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Você está alterando este campo repetidamente. Aguarde um instante.'
            ]);

            return;
        }

        $this->isThrottled = false;
        RateLimiter::hit($throttleKey, 20);

        // Update the business settings
        $business->update([
            'notification_settings' => $this->settings
        ]);

        $this->dispatch('notify', [
            'type' => 'success',
            'message' => 'Preferências de notificação atualizadas.'
        ]);
    }

    public function render()
    {
        return view('livewire.settings.notifications');
    }
}
