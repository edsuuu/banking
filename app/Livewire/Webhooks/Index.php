<?php

namespace App\Livewire\Webhooks;

use Livewire\Component;
use App\Models\BusinessWebhook;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $activeTab = 'webhooks';
    public $search = '';
    public $statusCode = '';
    public $eventName = '';

    protected $listeners = [
        'webhook-created' => '$refresh',
        'webhook-updated' => '$refresh',
        'webhook-deleted' => '$refresh',
    ];

    public function toggleActive($webhookId)
    {
        $webhook = BusinessWebhook::where('business_id', Auth::user()->business_id)->find($webhookId);
        
        if ($webhook) {
            $webhook->is_active = !$webhook->is_active;
            $webhook->save();
            $this->dispatch('notify', ['type' => 'success', 'message' => 'Status do webhook atualizado.']);
        }
    }

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        $businessId = Auth::user()->business_id;
        
        // Base Query for Webhooks
        $webhooksQuery = BusinessWebhook::where('business_id', $businessId);
        $webhooks = $webhooksQuery->clone()
            ->withCount('logs')
            ->latest()
            ->get();

        // Metrics (using cloned query to avoid side effects if we add filters later to webhooks list)
        $webhookIds = $webhooks->pluck('id');
        $events24h = \App\Models\WebhookLog::whereIn('business_webhook_id', $webhookIds)
            ->where('created_at', '>=', now()->subDay())
            ->count();

        $totalLogsMetric = \App\Models\WebhookLog::whereIn('business_webhook_id', $webhookIds)->count();
        $successLogsMetric = \App\Models\WebhookLog::whereIn('business_webhook_id', $webhookIds)
            ->whereBetween('status_code', [200, 299])
            ->count();

        $successRate = $totalLogsMetric > 0 ? ($successLogsMetric / $totalLogsMetric) * 100 : 0;

        // Logs Tab Query
        $logs = [];
        if ($this->activeTab === 'logs') {
            $logsQuery = \App\Models\WebhookLog::whereIn('business_webhook_id', $webhookIds);

            if ($this->search) {
                // Assuming payload is JSON, searching text might depend on DB capabilities. 
                // For simplicity or if payload is cast, we might use like. 
                // Adjust field based on actual schema (e.g., payload, event_name).
                $logsQuery->where(function ($q) {
                    $q->where('event_name', 'like', '%' . $this->search . '%')
                      ->orWhere('payload', 'like', '%' . $this->search . '%');
                });
            }

            if ($this->statusCode) {
                $logsQuery->where('status_code', $this->statusCode);
            }

            if ($this->eventName) {
                $logsQuery->where('event_name', 'like', '%' . $this->eventName . '%');
            }

            $logs = $logsQuery->latest()->paginate(15);
        }

        return view('livewire.webhooks.index', [
            'webhooks' => $webhooks,
            'totalWebhooks' => $webhooks->count(),
            'events24h' => $events24h,
            'successRate' => $successRate,
            'logs' => $logs,
        ]);
    }
}
