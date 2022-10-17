<?php

namespace App\Listeners;

use App\Events\TamuCheckIn;
use App\Models\Logtamu;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;

class CheckIn
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\TamuCheckIn  $event
     * @return void
     */
    public function handle(TamuCheckIn $event)
    {
        //
        $tamu = $event->getReq();
        dd($tamu);
        // Logtamu::create([
        //     'tamu_id'=> $tamu->id,
        // ]);
    }
}
