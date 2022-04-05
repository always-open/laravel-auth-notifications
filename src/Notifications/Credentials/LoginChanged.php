<?php

namespace AlwaysOpen\AuthNotifications\Notifications\Credentials;

use AlwaysOpen\AuthNotifications\Events\LoginWasChanged;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LoginChanged extends Notification
{
    use Queueable;

    public function __construct(protected LoginWasChanged $event)
    {
        //
    }

    public function via(mixed $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(mixed $notifiable): MailMessage
    {
        $field = config('auth-notifications.listen_to.login_changed.field');
        $value = $notifiable->{$field};

        $originalAddress = $notifiable->getOriginal($field);

        return (new MailMessage)
                    ->cc($originalAddress)
                    ->subject("Account Security: " . ucfirst($field) . " successfully changed!")
                    ->line("Your {$field} has been successfully changed to {$value}. If you did not make this change, please contact us immediately.");
    }

    public function toArray(mixed $notifiable): array
    {
        return [
            //
        ];
    }
}
