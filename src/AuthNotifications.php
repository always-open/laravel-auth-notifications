<?php

declare(strict_types=1);

namespace AlwaysOpen\AuthNotifications;

use AlwaysOpen\AuthNotifications\Events\LoginWasChanged;
use AlwaysOpen\AuthNotifications\Events\PasswordWasChanged;
use AlwaysOpen\AuthNotifications\Events\TwoFactorWasDisabled;
use AlwaysOpen\AuthNotifications\Events\TwoFactorWasEnabled;
use AlwaysOpen\AuthNotifications\Notifications\Credentials\LoginChanged;
use AlwaysOpen\AuthNotifications\Notifications\Credentials\PasswordChanged;
use AlwaysOpen\AuthNotifications\Notifications\Credentials\TwoFactorDisabled;
use AlwaysOpen\AuthNotifications\Notifications\Credentials\TwoFactorEnabled;
use AlwaysOpen\AuthNotifications\Notifications\Login\Failed as LoginFailed;
use AlwaysOpen\AuthNotifications\Notifications\Login\Lockout as LoginLockout;
use AlwaysOpen\AuthNotifications\Notifications\Login\Validated as LoginValidated;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Traits\Macroable;

class AuthNotifications
{
    use Macroable;

    public function handleValidated(Validated $event): void
    {
        if (! in_array($event->guard, config('auth-notifications.listen_to.login_validated.guards'))) {
            return;
        }

        $event->user->notify(new LoginValidated($event, request()));
    }

    public function handleFailed(Failed $event): void
    {
        if (! in_array($event->guard, config('auth-notifications.listen_to.login_failed.guards'))) {
            return;
        }
        
        if (empty($event->user)) {
            return;
        }

        $event->user->notify(new LoginFailed($event, request()));
    }

    public function handleLockout(Lockout $event): void
    {
        $userClass = config('auth-notifications.user_model');
        if (! $user = $userClass::where('email', $event->request->email)->first()) {
            return;
        }

        $user->notify(new LoginLockout($event));
    }

    public function handleLoginWasChanged(LoginWasChanged $event): void
    {
        $event->user->notify(new LoginChanged($event));
    }

    public function handlePasswordWasChanged(PasswordWasChanged $event): void
    {
        $event->user->notify(new PasswordChanged($event));
    }

    public function handleTwoFactorWasEnabled(TwoFactorWasEnabled $event): void
    {
        $event->user->notify(new TwoFactorEnabled($event));
    }

    public function handleTwoFactorWasDisabled(TwoFactorWasDisabled $event): void
    {
        $event->user->notify(new TwoFactorDisabled($event));
    }
}
