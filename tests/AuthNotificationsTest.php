<?php

declare(strict_types=1);

namespace AlwaysOpen\ProcessStamps\Tests;

use AlwaysOpen\AuthNotifications\Notifications\Credentials\PasswordChanged;
use AlwaysOpen\AuthNotifications\Notifications\Credentials\TwoFactorDisabled;
use AlwaysOpen\AuthNotifications\Notifications\Credentials\TwoFactorEnabled;
use AlwaysOpen\AuthNotifications\Notifications\Login\Failed as LoginFailed;
use AlwaysOpen\AuthNotifications\Notifications\Login\Lockout as LoginLockout;
use AlwaysOpen\AuthNotifications\Notifications\Login\Validated as LoginValidated;
use AlwaysOpen\AuthNotifications\Tests\Fakes\UserModel;
use AlwaysOpen\AuthNotifications\Tests\TestCase;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Auth\Events\Validated;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;

class AuthNotificationsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = UserModel::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'secret',
        ]);
    }

    /** @test */
    public function user_notified_upon_new_web_login(): void
    {
        Notification::fake();

        Event::dispatch(new Validated('web', $this->user));

        Notification::assertSentTo(
            $this->user,
            LoginValidated::class
        );
    }

    /** @test */
    public function user_notified_upon_new_api_login(): void
    {
        Notification::fake();

        Event::dispatch(new Validated('api', $this->user));

        Notification::assertNothingSent();
    }

    /** @test */
    public function user_notified_upon_failed_web_login(): void
    {
        Notification::fake();

        Event::dispatch(new Failed('web', $this->user, []));

        Notification::assertSentTo(
            $this->user,
            LoginFailed::class
        );
    }

    /** @test */
    public function user_notified_upon_failed_api_login(): void
    {
        Notification::fake();

        Event::dispatch(new Failed('api', $this->user, []));

        Notification::assertNothingSent();
    }

    /** @test */
    public function user_notified_upon_lockout(): void
    {
        Notification::fake();

        $request = request();
        $request->email = $this->user->email;

        Event::dispatch(new Lockout($request));

        Notification::assertSentTo(
            $this->user,
            LoginLockout::class
        );
    }

    /** @test */
    public function user_notified_upon_password_change(): void
    {
        Notification::fake();

        $this->user->password = 'new-password';
        $this->user->save();

        Notification::assertSentTo(
            $this->user,
            PasswordChanged::class
        );
    }

    /** @test */
    public function user_notified_upon_two_factor_enabled(): void
    {
        Notification::fake();

        $this->user->two_factor_secret = 'secret';
        $this->user->save();

        Notification::assertSentTo(
            $this->user,
            TwoFactorEnabled::class
        );
    }

    /** @test */
    public function user_notified_upon_two_factor_disabled(): void
    {
        Notification::fake();

        $user = UserModel::create([
            'name' => 'Jane Doe',
            'email' => 'test@example.com',
            'two_factor_secret' => 'secret',
        ]);

        Notification::assertNothingSent();

        $user->two_factor_secret = null;
        $user->save();

        Notification::assertSentTo(
            $user,
            TwoFactorDisabled::class
        );
    }
}
