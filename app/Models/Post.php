<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Importamos nuestro evento.
use App\Events\PostCreated;

class Post extends Model
{
    use HasFactory;

    // Relación de uno a muchos.
    public function user(){
       // Un blog le pertenece a un usuario.
       return $this->belongsTo(User::class);
    }

    protected $fillable=[
        'title',
        'body'
    ];

    // Enviar notificación cada que se cree un nuevo post.
    protected $dispatchesEvents=[
        'created'=>PostCreated::class
    ];
}
