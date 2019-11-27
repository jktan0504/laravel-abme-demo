<?php

namespace App\Notifications\ReportServices;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class ReportServiceNotification extends Notification
{
    use Queueable;
    public $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database']; //'broadcast'
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $title = $this->data['form_action_title'];
        $description = '['.$this->data['report_type'].'] ('.$this->data['report_id'].')had submmited by '.$this->data['submitted_by'].' ('.$this->data['submitted_by_id'].') at '.$this->data['created_at'].'';

        return [
            'title' => $title,
            'description' => $description,
            'report_no' => $this->data['report_id'],
            'report_type' => $this->data['report_type'],
            'sender_id' => $this->data['submitted_by_id'],
            'deeplink' => $this->data['link'],
            'color' => $this->data['notification_theme_color'],
            'icon' => $this->data['notification_icon'],
            'created_at' => $this->data['created_at']
        ];
    }

    /**
     * Get the broadcastable representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        $title = $this->data['form_action_title'];
        $description = '['.$this->data['report_type'].'] ('.$this->data['report_id'].')had submmited by '.$this->data['submitted_by'].' ('.$this->data['submitted_by_id'].') at '.$this->data['created_at'].'';

        return new BroadcastMessage([
            'title' => $title,
            'description' => $description,
            'report_no' => $this->data['report_id'],
            'report_type' => $this->data['report_type'],
            'sender_id' => $this->data['submitted_by_id'],
            'deeplink' => $this->data['link'],
            'color' => $this->data['notification_theme_color'],
            'icon' => $this->data['notification_icon'],
            'created_at' => $this->data['created_at']
        ]);
    }
}
