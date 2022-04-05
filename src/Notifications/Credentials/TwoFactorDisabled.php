<?php

namespace AlwaysOpen\AuthNotifications\Notifications\Credentials;

use AlwaysOpen\AuthNotifications\Events\TwoFactorWasDisabled;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TwoFactorDisabled extends Notification
{
    use Queueable;

    public function __construct(protected TwoFactorWasDisabled $event)
    {
        //
    }

    public function via(mixed $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(mixed $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Account Security: Two Factor Authentication disabled!')
                    ->line('Two factor authentication has been disabled for your account. If you did not make this change, please contact us immediately.');
    }

    public function toArray(mixed $notifiable): array
    {
        return [
            //
        ];
    }
}
