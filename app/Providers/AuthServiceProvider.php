<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Lang;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        

        ResetPassword::toMailUsing(function ($notifiable, $token) {
            // Generar la URL de restablecimiento usando la ruta 'password.reset'
            $url = url(route('password.reset', ['token' => $token, 'email' => $notifiable->getEmailForPasswordReset()], false));
        
            $mail = new MailMessage;
            $mail->subject('Solicitud de restablecimiento de contraseña')
                 ->greeting('Hola,')
                 ->line('Recibiste este correo porque se solicitó un restablecimiento de contraseña para tu cuenta.')
                 ->action('Restablecer Contraseña', $url)
                 ->line('Este enlace de restablecimiento de contraseña caducará en 60 minutos.')
                 ->line('Si no solicitaste un restablecimiento de contraseña, no necesitas realizar ninguna acción.')
                 ->salutation('Saludos,');
            return $mail;
        });
    }
}
