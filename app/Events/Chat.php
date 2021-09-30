<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Chat implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $lecture_id;
    public $student_id;
    public $message;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($lecture_id ,$student_id, $message)
    {
        $this->lecture_id = $lecture_id ;
        $this->student_id = $student_id ;
        $this->message = $message ;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('send');
    }

    public function broadcastAs()
    {
        return 'chat';
    }
}
