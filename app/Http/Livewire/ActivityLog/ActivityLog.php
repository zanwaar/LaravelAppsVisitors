<?php

namespace App\Http\Livewire\ActivityLog;


use App\Http\Livewire\Admin\AdminComponent as Component;
use Spatie\Activitylog\Models\Activity;

class ActivityLog extends Component
{

    public function render()
    {
        $mlog = Activity::latest()
            ->paginate(5);
        return view('livewire.activity-log.activity-log', ['log' => $mlog,]);
    }
}
