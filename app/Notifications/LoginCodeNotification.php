<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class LoginCodeNotification extends Notification
{
    use Queueable;

    public function __construct(
        public string $code,
        public string $url
    ) {}

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Seu código de acesso - DentalTask AI')
            ->markdown('emails.auth.login_code', [
                'code' => $this->code,
                'url'  => $this->url,
            ]);
    }
}
