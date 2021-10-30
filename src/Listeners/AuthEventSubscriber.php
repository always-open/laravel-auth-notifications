<?php

namespace App\Listeners;

use AlwaysOpen\AuthNotifications\Events\LoginWasChanged;
use AlwaysOpen\AuthNotifications\Events\TwoFactorWasDisabled;
use AlwaysOpen\AuthNotifications\Events\TwoFactorWasEnabled;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Validated;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Str;

class AuthEventSubscriber
{
    public function handleValidated(Validated $event): void
    {
        //
    }

    public function handleFailed(Failed $event): void
    {
        //
    }

    public function handleLockout(Lockout $event): void
    {
        //
    }

    public function handleLoginWasChanged(LoginWasChanged $event): void
    {
        //
    }

    public function handlePasswordWasChanged(PasswordWasChanged $event): void
    {
        //
    }

    public function handleTwoFactorWasEnabled(TwoFactorWasEnabled $event): void
    {
        //
    }

    public function handleTwoFactorWasDisabled(TwoFactorWasDisabled $event): void
    {
        //
    }

    public function subscribe(Dispatcher $events): void
    {
        collect(config('auth-notifications.listen_to'))->each(function($item) use($events) {
            $events->listen(
                $item,
                [
                    self::class,
                    Str::of($item)->classBasename()->prepend('handle')->camel(),
                ]
            );
        });
    }
}
