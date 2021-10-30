<?php

namespace AlwaysOpen\AuthNotifications;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use AlwaysOpen\AuthNotifications\Commands\AuthNotificationsCommand;

class AuthNotificationsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-auth-notifications')
            ->hasConfigFile();
    }
}
