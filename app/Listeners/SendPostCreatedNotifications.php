<?php

namespace App\Listeners;

use App\Events\PostCreated;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

// Utilizamos el modelo user.
use App\Models\User;

// Importamos las notificaciones.
use App\Notifications\NewPost;

// Decirle a Laravel que nuestro listener debe ejecutarse en una cola.

class SendPostCreatedNotifications implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\PostCreated  $event
     * @return void
     */
    public function handle(PostCreated $event)
    {
        // Enviar notificaciones a todos los usuarios de la plataforma, excepto al autor del post.
        foreach (User::whereNot('id', $event->post->user_id)->cursor() as $user){
            $user->notify(new NewPost($event->post));
        }
    }
}
