<?php

declare(strict_types=1);

namespace AlwaysOpen\AuthNotifications\Notifications\Login;

use Illuminate\Auth\Events\Validated as LoginValidated;
use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Validated extends Notification
{
    use Queueable;

    public function __construct(protected LoginValidated $event, protected Request $request)
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
                    ->subject('Account Security: A new sign in occurred for your account!')
                    ->line('A new sign in was successful for your account. If this was not you, please contact us immediately.')
                    ->line('IP Address: ' . $this->request->ip());
    }

    public function toArray(mixed $notifiable): array
    {
        return [
            //
        ];
    }
}
