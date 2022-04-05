<?php

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
use App\Models\User;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Auth\Events\Validated;

return [
    'user_model' => env('AUTH_NOTIFICATIONS_USER_MODEL', User::class),

    'listen_to' => [
        // Laravel Auth Events

        // When the user's credentials are accepted at login
        'login_validated' => [
            'event' => Validated::class,
            'enabled' => env('AUTH_NOTIFICATIONS_LOGIN_VALIDATED', false),
            'notification' => LoginValidated::class,
            'guards' => ['web'],
        ],

        // When the user's credentials are rejected at login
        'login_failed' => [
            'event' => Failed::class,
            'enabled' => env('AUTH_NOTIFICATIONS_LOGIN_FAILED', false),
            'notification' => LoginFailed::class,
            'guards' => ['web'],
        ],

        // When the user is locked out for too many login attempts
        'login_lockout' => [
            'event' => Lockout::class,
            'enabled' => env('AUTH_NOTIFICATIONS_LOGIN_LOCKOUT', false),
            'notification' => LoginLockout::class,
        ],

        // Laravel Auth Notifications Custom Events
        'login_changed' => [
            'event' => LoginWasChanged::class,
            'enabled' => env('AUTH_NOTIFICATIONS_CREDENTIALS_LOGINCHANGED', false),
            'notification' => LoginChanged::class,
            'field' => 'email',
        ],
        'password_changed' => [
            'event' => PasswordWasChanged::class,
            'enabled' => env('AUTH_NOTIFICATIONS_CREDENTIALS_PASSWORDCHANGED', false),
            'notification' => PasswordChanged::class,
            'field' => 'password',
        ],
        'twofactor_enabled' => [
            'event' => TwoFactorWasEnabled::class,
            'enabled' => env('AUTH_NOTIFICATIONS_CREDENTIALS_TWOFACTORENABLED', false),
            'notification' => TwoFactorEnabled::class,
            'field' => 'two_factor_secret',
        ],
        'twofactor_disabled' => [
            'event' => TwoFactorWasDisabled::class,
            'enabled' => env('AUTH_NOTIFICATIONS_CREDENTIALS_TWOFACTORDISABLED', false),
            'notification' => TwoFactorDisabled::class,
            'field' => 'two_factor_secret',
        ],
    ],
];
