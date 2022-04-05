# Laravel Auth Notifications

[![Latest Version on Packagist](https://img.shields.io/packagist/v/always-open/laravel-auth-notifications.svg?style=flat-square)](https://packagist.org/packages/always-open/laravel-auth-notifications)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/always-open/laravel-auth-notifications/run-tests?label=tests)](https://github.com/always-open/laravel-auth-notifications/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/always-open/laravel-auth-notifications/Check%20&%20fix%20styling?label=code%20style)](https://github.com/always-open/laravel-auth-notifications/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/always-open/laravel-auth-notifications.svg?style=flat-square)](https://packagist.org/packages/always-open/laravel-auth-notifications)

---
A Laravel package to notify your users when their password, two-factor authentication, or login status changes.

## Installation

You can install the package via composer:

```bash
composer require always-open/laravel-auth-notifications
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="AlwaysOpen\AuthNotifications\AuthNotificationsServiceProvider" --tag="laravel-auth-notifications-config"
```

## Usage

By default all of the notifications are turned off. To enable them, declare the appropriate environment variable like `AUTH_NOTIFICATIONS_LOGIN_VALIDATED=true`. Framework login events track the `Illuminate\Auth\Events\Validated`, `Illuminate\Auth\Events\Failed`, and `Illuminate\Auth\Events\Lockout` events. 

For credential notifications, we are simply watching the user model for changes. If you'd rather fire those events manually, set the corresponding field to a blank string and dispatch `AlwaysOpen\AuthNotifications\Events\LoginWasChanged`, `AlwaysOpen\AuthNotifications\Events\PasswordWasChanged`, `AlwaysOpen\AuthNotifications\Events\TwoFactorWasEnabled`, or `AlwaysOpen\AuthNotifications\Events\TwoFactorWasDisabled` with the only parameter being the user object to send to.

You may also override the notifications that are sent by creating your own notifications via `php artisan make:notification` and overriding the class defined in the `config/auth-notifications.php`.

## Testing

```bash
composer test
```

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Tom Schlick](https://github.com/tomschlick)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
