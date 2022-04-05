<?php

declare(strict_types=1);

namespace AlwaysOpen\AuthNotifications\Notifications\Credentials;

use AlwaysOpen\AuthNotifications\Events\TwoFactorWasEnabled;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TwoFactorEnabled extends Notification
{
    use Queueable;

    public function __construct(protected TwoFactorWasEnabled $event)
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
                    ->subject('Account Security: Two Factor Authentication enabled!')
                    ->line('Two factor authentication has been enabled for your account. If you did not make this change, please contact us immediately.');
    }

    public function toArray(mixed $notifiable): array
    {
        return [
            //
        ];
    }
}
