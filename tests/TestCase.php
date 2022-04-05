<?php

namespace AlwaysOpen\AuthNotifications\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use AlwaysOpen\AuthNotifications\AuthNotificationsServiceProvider;

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
