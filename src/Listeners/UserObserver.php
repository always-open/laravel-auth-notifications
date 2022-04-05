<?php

namespace AlwaysOpen\AuthNotifications\Listeners;

use App\Models\User;

class UserObserver
{
    public function updated($user): void
    {
        if ($user->recentlyCreated) {
            return;
        }

        if ($user->wasChanged(config('auth-notifications.listen_to.login_changed.field'))) {
            config('auth-notifications.listen_to.login_changed.event')::dispatch($user);
        }

        if ($user->wasChanged(config('auth-notifications.listen_to.password_changed.field'))) {
            config('auth-notifications.listen_to.password_changed.event')::dispatch($user);
        }

        if ($user->wasChanged(config('auth-notifications.listen_to.twofactor_enabled.field')) && !empty($user->{config('auth-notifications.listen_to.twofactor_enabled.field')})) {
            config('auth-notifications.listen_to.twofactor_enabled.event')::dispatch($user);
        }

        if ($user->wasChanged(config('auth-notifications.listen_to.twofactor_disabled.field')) && empty($user->{config('auth-notifications.listen_to.twofactor_disabled.field')})) {
            config('auth-notifications.listen_to.twofactor_disabled.event')::dispatch($user);
        }
    }
}
