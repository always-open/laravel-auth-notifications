<?php

declare(strict_types=1);

namespace AlwaysOpen\AuthNotifications\Notifications\Credentials;

use AlwaysOpen\AuthNotifications\Events\PasswordWasChanged;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordChanged extends Notification
{
    use Queueable;

    public function __construct(protected PasswordWasChanged $event)
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
                ->subject('Account Security: Password successfully changed!')
                ->line('Your password has been successfully changed. If you did not make this change, please contact us immediately.');
    }

    public function toArray(mixed $notifiable): array
    {
        return [
            //
        ];
    }
}
