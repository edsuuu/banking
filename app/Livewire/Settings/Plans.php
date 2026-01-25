<?php

namespace App\Livewire\Settings;

use Livewire\Component;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;

class Plans extends Component
{
    public function render()
    {
        $business = Auth::user()->business;
        $plans = Plan::query()->get();

        return view('livewire.settings.plans', [
            'plans' => $plans,
            'currentPlanId' => $business?->plan_id
        ]);
    }
}
