<?php

namespace App\Http\Livewire\ActivityLog;

use App\Http\Livewire\AppComponent;
use Spatie\Activitylog\Models\Activity;

class ActivityLog extends AppComponent
{

    public function render()
    {
        $mlog = Activity::latest()
            ->paginate(15);
        return view('livewire.activity-log.activity-log', ['log' => $mlog,]);
    }
}
