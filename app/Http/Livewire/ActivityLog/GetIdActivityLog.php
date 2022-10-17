<?php

namespace App\Http\Livewire\ActivityLog;

use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Admin\AdminComponent as Component;
use Livewire\WithPagination;
use Spatie\Activitylog\Models\Activity;

class GetIdActivityLog extends Component
{
    public function render()
    {
        $user =  Auth::user();
        $log = Activity::latest()
            ->where('causer_id', $user->getAuthIdentifier())
            ->paginate(5);
        return view('livewire.activity-log.get-id-activity-log', [
            'log' => $log,
        ]);
    }
}
