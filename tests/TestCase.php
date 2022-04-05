<?php

declare(strict_types=1);

namespace AlwaysOpen\AuthNotifications\Tests;

use AlwaysOpen\AuthNotifications\AuthNotificationsServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/Fakes/migrations/');
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            AuthNotificationsServiceProvider::class,
        ];
    }
}
