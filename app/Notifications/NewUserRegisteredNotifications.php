<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewUserRegisteredNotifications extends Notification
{
    use Queueable;

    /**
     * @var
     * To Send Notifications To User
     */
    public $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($newUser)
    {
        /**
         * User Who Make Register
         */
        $this->user = $newUser;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            /**
             * Data User In Database Or in migrations file
             */
            'name' => $this->user->name,
            'email' => $this->user->email,
            'message' => 'New User Registered' . $this->user->name
        ];
    }
}
