<?php

declare(strict_types=1);

namespace AlwaysOpen\AuthNotifications\Tests\Fakes;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserModel extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $guarded = [];
}
