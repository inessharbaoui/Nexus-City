<?php
namespace App\Events;

use App\Models\TrafficData;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\BroadcastsEvents;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TrafficDataUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $trafficData;

    public function __construct(TrafficData $trafficData)
    {
        $this->trafficData = $trafficData;
    }

    public function broadcastOn()
    {
        return new Channel('traffic-data');
    }
}
