<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;
use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail; 

class CustomVerifyEmail extends BaseVerifyEmail
{
    use Queueable;

    /**
     * Get the mail representation of the notification.
     *
     * IMPORTANT: The signature must match the parent class (VerifyEmail).
     */
    public function toMail($notifiable) // <-- FIX: Removed the type hints (object and : MailMessage)
    {
        // We call the inherited method to correctly generate the signed URL
        $verificationUrl = $this->verificationUrl($notifiable);
        
        // Customize the content with your Linya branding
        return (new MailMessage)
            ->subject(Lang::get('Activate Your FeedBox Account - Email Verification'))
            
            ->greeting('Welcome Aboard, ' . $notifiable->name . '!')
            
            ->line(Lang::get('Thank you for registering with FeedBox! We are excited to have you.'))
            ->line(Lang::get('Please click the button below to verify your email address and complete your setup.'))
            
            ->action(Lang::get('Verify My FeedBox Email'), $verificationUrl)
            
            ->line(Lang::get('If you did not register for an account, please disregard this email.'));
    }

    // You can keep or remove other methods like toArray/via as needed.
}