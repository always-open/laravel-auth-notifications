<?php

declare(strict_types=1);

namespace AlwaysOpen\AuthNotifications\Notifications\Login;

use Illuminate\Auth\Events\Lockout as LoginLockout;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Lockout extends Notification
{
    use Queueable;

    public function __construct(protected LoginLockout $event)
    {
        //
    }

    public function via(mixed $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(mixed $notifiable): MailMessage
    {
        return (new MailMessage())
                    ->subject('Account Security: Your account has been temporarily locked out!')
                    ->line('Your account has had too many unsuccessful logins in the past few minutes, as a security precaution, we have temporarily disabled your ability to login. Please wait a few moments before you try again. If these attempts were not made by you, please contact us immediately.')
                    ->line('IP Address: ' . $this->event->request->ip());
    }

    public function toArray(mixed $notifiable): array
    {
        return [
            //
        ];
    }
}
