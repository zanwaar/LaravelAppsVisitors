<?php

namespace App\Http\Livewire\ActivityLog;

use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\AppComponent;
use Spatie\Activitylog\Models\Activity;

class GetIdActivityLog extends AppComponent
{
    public function render()
    {
        $user =  Auth::user();
        $log = Activity::latest()
            ->where('causer_id', $user->getAuthIdentifier())
            ->paginate($this->trow);
        return view('livewire.activity-log.get-id-activity-log', [
            'log' => $log,
        ]);
    }
}
