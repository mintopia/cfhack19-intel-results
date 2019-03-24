<?php

namespace App\Events;

use App\Result;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\Channel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ResultSubmittedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $result;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Result $result)
    {
        $this->result = $result;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('results');
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->result->uuid,
            'data' => $this->result->data,
            'image_url' => $this->result->image_url,
            'created_at' => $this->result->created_at,
        ];
    }
}
