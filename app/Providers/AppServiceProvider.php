<?php

namespace App\Providers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Mailer\Bridge\Sendgrid\Transport\SendgridTransportFactory;
use Symfony\Component\Mailer\Transport\Dsn;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Mail::extend('sendgrid', function (array $config = []) {
            // Add this check to debug missing keys
            if (empty($config['api_key'])) {
                throw new \InvalidArgumentException('SendGrid API key is missing in config/mail.php');
            }

            return (new SendGridTransportFactory)->create(
                new Dsn(
                    'sendgrid+api',
                    'default',
                    $config['api_key']
                )
            );
        });
    }
}
