<?php

namespace App\Events;

use App\Models\Bagian;
use App\Models\Tamu;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;

class TamuCheckIn
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private Tamu $tamuExecuted;
    private Request $tamureq;

    public function getTamu()
    {
        return  $this->tamuExecuted;
    }
    public function getReq()
    {
        return  $this->tamureq;
    }

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Tamu $tamu, Request $request)
    {
        $this->tamuExecuted = $tamu;
        $this->tamureq = $request;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
