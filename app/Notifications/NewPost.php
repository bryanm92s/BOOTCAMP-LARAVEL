<?php

namespace App\Notifications;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

// Para utilizar las notificaciones importamos lo siguiente.
use App\Models\Post;
use Illuminate\Support\Str;

class NewPost extends Notification
{
    use Queueable;

    // Enviamos public Post $post al constructor.
    public function __construct(public Post $post)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
        // Configuramos la notificación que se va a enviar por correo.
        ->subject("New Post From: {$this->post->user->name}")
        ->greeting("New Post From: {$this->post->user->name}")
        ->line(Str::limit($this->post->message,50))
        ->action('Go to Post', url('/posts'))
        ->line('Thank you for using our application');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
