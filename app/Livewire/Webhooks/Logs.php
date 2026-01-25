<?php

namespace App\Livewire\Webhooks;

use Livewire\Component;
use App\Models\BusinessWebhook;
use App\Models\WebhookLog;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class Logs extends Component
{
    use WithPagination;

    public $webhookId;
    public $webhook;

    public function mount($webhookId = null)
    {
        if ($webhookId) {
            $this->webhookId = $webhookId;
            $this->webhook = BusinessWebhook::where('business_id', Auth::user()->business_id)
                ->find($webhookId);
        }
    }

    public function close()
    {
        $this->dispatch('closeLogsModal');
    }

    public function render()
    {
        $logs = WebhookLog::where('business_webhook_id', $this->webhookId)
            ->latest()
            ->paginate(10);

        return view('livewire.webhooks.logs', [
            'logs' => $logs
        ]);
    }
}
