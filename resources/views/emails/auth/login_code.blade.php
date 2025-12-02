@component('mail::message')
# Olá!

Use o código abaixo para entrar na sua conta DentalTask AI:

@component('mail::panel')
<div style="text-align:center; font-size: 32px; font-weight: bold; letter-spacing:4px;">
    {{ $code }}
</div>
@endcomponent

@component('mail::button', ['url' => $url])
Digitar o código
@endcomponent

Se você não solicitou este código, pode ignorar este e-mail.

Abraços,  
**DentalTask AI**
@endcomponent
