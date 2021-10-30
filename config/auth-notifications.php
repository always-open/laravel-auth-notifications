<?php

use AlwaysOpen\AuthNotifications\Events\LoginWasChanged;
use AlwaysOpen\AuthNotifications\Events\PasswordWasChanged;
use AlwaysOpen\AuthNotifications\Events\TwoFactorWasEnabled;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Auth\Events\Validated;

return [
    'listen_to' => [
        // Laravel Auth Events

        // When the user's credentials are accepted at login
        Validated::class,

        // When the user's credentials are rejected at login
        Failed::class,

        // When the user is locked out for too many login attempts
        Lockout::class,

        // Laravel Auth Notifications Custom Events
        LoginWasChanged::class,
        PasswordWasChanged::class,
        TwoFactorWasEnabled::class,
        TwoFactorWasEnabled::class,
    ],
];
