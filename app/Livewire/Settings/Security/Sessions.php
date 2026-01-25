<?php

namespace App\Livewire\Settings\Security;

use App\Livewire\Actions\Logout;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Jenssegers\Agent\Agent;

class Sessions extends Component
{
    public $showTwoFactorModal = false;
    public $selectedSessions = [];
    public $selectAll = false;
    
    public $confirmingAction = null;
    public $sessionToLogout = null;
    public $confirmationPassword = '';

    protected $listeners = [
        'close-two-factor-modal' => 'closeTwoFactorModal',
        'two-factor-disabled' => '$refresh'
    ];

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedSessions = $this->sessions->pluck('id')->toArray();
        } else {
            $this->selectedSessions = [];
        }
    }

    public function updatedSelectedSessions()
    {
        $this->selectAll = count($this->selectedSessions) === count($this->sessions);
    }

    public function openTwoFactorModal()
    {
        $this->showTwoFactorModal = true;
    }

    public function closeTwoFactorModal()
    {
        $this->showTwoFactorModal = false;
    }

    public function confirmLogoutSingle($sessionId)
    {
        $this->sessionToLogout = $sessionId;
        $this->confirmingAction = 'logout_single';
    }

    public function confirmLogoutSelected()
    {
        if (empty($this->selectedSessions)) return;
        $this->confirmingAction = 'logout_selected';
    }

    public function confirmLogoutOtherSessions()
    {
        $this->resetErrorBag();
        $this->confirmationPassword = '';
        $this->confirmingAction = 'logout_others';
    }

    public function cancelConfirmation()
    {
        $this->confirmingAction = null;
        $this->sessionToLogout = null;
        $this->reset('confirmationPassword');
        $this->resetErrorBag();
    }

    public function executeLogout()
    {
        $ids = $this->confirmingAction === 'logout_single' ? [$this->sessionToLogout] : $this->selectedSessions;

        if (empty($ids)) {
            $this->cancelConfirmation();
            return;
        }

        $currentSessionId = Session::getId();
        $shouldLogoutCurrent = in_array($currentSessionId, $ids);

        DB::connection(config('session.connection'))->table(config('session.table', 'sessions'))
            ->where('user_id', auth()->user()->getAuthIdentifier())
            ->whereIn('id', $ids)
            ->delete();

        if ($this->confirmingAction === 'logout_single') {
            $this->selectedSessions = array_diff($this->selectedSessions, [$this->sessionToLogout]);
        } else {
            $this->selectedSessions = [];
        }
        
        $this->cancelConfirmation();

        if ($shouldLogoutCurrent) {
            return (new Logout)();
        }

        $this->dispatch('sessions-updated');
    }

    public function logoutOtherBrowserSessions()
    {
        $this->validate([
            'confirmationPassword' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (! Hash::check($value, Auth::user()->password)) {
                        $fail('A senha informada está incorreta.');
                    }
                },
            ],
        ]);

        auth()->guard('web')->logoutOtherDevices($this->confirmationPassword);

        $this->deleteOtherSessionRecords();

        $this->selectedSessions = [];
        $this->cancelConfirmation();

        $this->dispatch('logged-out');
        $this->dispatch('sessions-updated');
    }

    protected function deleteOtherSessionRecords()
    {
        if (config('session.driver') !== 'database') {
            return;
        }

        DB::connection(config('session.connection'))->table(config('session.table', 'sessions'))
            ->where('user_id', auth()->user()->getAuthIdentifier())
            ->where('id', '!=', Session::getId())
            ->delete();
    }

    public function getSessionsProperty()
    {
        if (config('session.driver') !== 'database') {
            return collect();
        }

        return DB::connection(config('session.connection'))->table(config('session.table', 'sessions'))
                ->where('user_id', auth()->user()->getAuthIdentifier())
                ->orderBy('last_activity', 'desc')
                ->get()
                ->map(function ($session) {
                    return (object) [
                        'id' => $session->id,
                        'agent' => $this->createAgent($session->user_agent),
                        'ip_address' => $session->ip_address,
                        'is_current_device' => $session->id === Session::getId(),
                        'last_active' => Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
                    ];
                });
    }

    protected function createAgent($userAgent)
    {
        $agent = tap(new Agent, fn ($agent) => $agent->setUserAgent($userAgent));

        return (object) [
            'isDesktop' => $agent->isDesktop(),
            'platform' => $agent->platform(),
            'browser' => $agent->browser(),
            'version' => $agent->version($agent->browser()),
        ];
    }

    public function render()
    {
        return view('livewire.settings.security.sessions', [
            'sessions' => $this->sessions,
        ]);
    }
}
