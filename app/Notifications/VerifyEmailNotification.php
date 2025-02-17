<?php

// app/Notifications/VerifyEmailNotification.php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class VerifyEmailNotification extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $verificationUrl = url("/api/email/verify/{$notifiable->UserID}/" . sha1($notifiable->Email));

        return (new MailMessage)
            ->subject('تفعيل البريد الإلكتروني')
            ->line('انقر على الزر أدناه لتفعيل بريدك الإلكتروني.')
            ->action('تفعيل الحساب', $verificationUrl);
    }
}
