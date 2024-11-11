<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdStatusNotification extends Notification
{
    use Queueable;

    protected $status;
    protected $adTitle;

    /**
     * Create a new notification instance.
     */
    public function __construct($status, $adTitle)
    {
        $this->status = $status;
        $this->adTitle = $adTitle;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable)
    {
        return [
            'message' => "Your ad '{$this->adTitle}' has been {$this->status}.",
            'ad_title' => $this->adTitle,
            'status' => $this->status,
        ];
    }
}
