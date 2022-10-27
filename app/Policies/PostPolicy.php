<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Post $post)
    {
        //
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, Post $post)
    {
        // Política para actualizar posts.
        // Que la persona que está logueada si sea la que creó el post y pueda actualizarlo.
        return $post->user()->is($user);
    }

    public function delete(User $user, Post $post)
    {
        // Política para eliminar posts.
        // Solo los propiedatios de los posts pueden eliminarlo.
        return $post->user()->is($user);

        // Como en update utilizamos el mismo return podemos hacer lo siguiente.
        // return $this->update($user, $post);
    }

    public function restore(User $user, Post $post)
    {
        //
    }

    public function forceDelete(User $user, Post $post)
    {
        //
    }
}
