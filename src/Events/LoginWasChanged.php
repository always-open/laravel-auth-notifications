<?php

namespace AlwaysOpen\AuthNotifications\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LoginWasChanged
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public function __construct(public $user)
    {
        //
    }
}
