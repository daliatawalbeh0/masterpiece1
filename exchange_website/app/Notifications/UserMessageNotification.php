<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserMessageNotification extends Notification
{
    use Queueable;

    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['database']; // يمكنك تحديد 'mail' أو 'broadcast' إذا كنت تريد استخدامهم.
    }


    public function toArray($notifiable)
    {
        return [
            'message' => $this->message,
        ];
    }
}
