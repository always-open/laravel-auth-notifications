<?php

declare(strict_types=1);

namespace AlwaysOpen\AuthNotifications\Notifications\Login;

use Illuminate\Auth\Events\Failed as LoginFailed;
use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Failed extends Notification
{
    use Queueable;

    public function __construct(protected LoginFailed $event, protected Request $request)
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
                    ->subject('Account Security: A rejected sign in for your account!')
                    ->line('We detected an attempted sign in for your account that used the wrong credentials. If this was not you, please contact us immediately.')
                    ->line('IP Address: ' . $this->request->ip());
    }

    public function toArray(mixed $notifiable): array
    {
        return [
            //
        ];
    }
}
