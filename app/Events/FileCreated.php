<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FileCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public int $file_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(int $file_id)
    {
        $this->file_id = $file_id;
    }
}
