<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class CustomVerifyEmail extends VerifyEmail
{
    public function toMail($notifiable): MailMessage
    {
        $url = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('Confirme seu e-mail - DentalTask AI')
            ->greeting('Olá!')
            ->line('Clique no botão abaixo para confirmar seu endereço de e-mail e acessar sua conta DentalTask AI.')
            ->action('Confirmar e-mail', $url)
            ->line('Se você não criou esta conta, pode simplesmente ignorar este e-mail.')
            ->salutation('Abraços, DentalTask AI');
    }
}
