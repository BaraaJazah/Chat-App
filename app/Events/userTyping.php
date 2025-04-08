<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class userTyping implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $typerId;
    public $recieverId;


    public function __construct($typerId, $recieverId)
    {
        $this->typerId = $typerId;
        $this->recieverId = $recieverId;
    }

    public function broadcastOn(): array
    {
        // id للشخص يلي عم يكتب
        return [
            new PrivateChannel($this->typerId . '.typingTo.' . $this->recieverId),
        ];
    }
}
