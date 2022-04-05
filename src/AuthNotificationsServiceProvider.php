<?php

declare(strict_types=1);

namespace AlwaysOpen\AuthNotifications;

use AlwaysOpen\AuthNotifications\Listeners\UserObserver;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Str;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class AuthNotificationsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-auth-notifications')
            ->hasConfigFile();
    }

    public function boot(): void
    {
        parent::boot();

        $model = config('auth-notifications.user_model', config('auth.providers.users.model'));
        $model::observe(UserObserver::class);


        collect(config('auth-notifications.listen_to'))->each(function ($item): void {
            app(Dispatcher::class)->listen(
                $item['event'],
                [
                    AuthNotifications::class,
                    Str::of($item['event'])->classBasename()->prepend('handle')->camel()->__toString(),
                ]
            );
        });
    }
}
