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
        $throttleKey = 'toggle-notifications-' . $business->id . '-' . $key;

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $this->isThrottled = true;
            $this->settings = array_merge($this->settings, $business->notification_settings ?? []);

            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Você está alterando este campo repetidamente. Aguarde um instante.'
            ]);

            return;
        }

        $this->isThrottled = false;
        RateLimiter::hit($throttleKey, 20);

        try {
            $business->update([
                'notification_settings' => $this->settings
            ]);

            $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'Preferências de notificação atualizadas.'
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::channel('daily')->error('Notification Update Error: ' . $e->getMessage(), [
                'business_id' => $business->id,
                'settings' => $this->settings,
                'exception' => $e
            ]);

            $this->settings = array_merge($this->settings, $business->notification_settings ?? []);

            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Não foi possível salvar suas preferências agora. Tente novamente mais tarde.'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.settings.notifications');
    }
}
