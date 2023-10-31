<?php

namespace App\Events;

use App\Models\Sweepstake;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SweepstakeCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Sweepstake $sweepstake;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Sweepstake $sweepstake)
    {
        $this->sweepstake = $sweepstake;
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
