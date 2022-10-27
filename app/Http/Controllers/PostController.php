<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{

    public function index()
    {
        //
        return Inertia::render('Posts/Index', [
            // Traer el id del usuario y el nombre del usuario asociado a cada post, trayendo el mas reciente.
            'posts' => Post::with('user:id,name')->latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        // Validamos los datos.
        // La validación la guardamos en una variable.
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'body' => 'required|string|max:255'
        ]);

        // Relación de uno a muchos.
        $request->user()->posts()->create($validated);

        // Retornamos a una vista.
        return redirect(route('posts.index'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        // Validamos los datos.
        // La validación la guardamos en una variable.
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'body' => 'required|string|max:255'
        ]);

        $post->update($validated);
        return redirect(route('posts.index'));
    }

    public function destroy(Post $post)
    {
        // Los usuarios que han creado sus posts, puedanm editarlo y eliminarlo.
        $this->authorize('delete', $post);
        $post->delete();
        return redirect(route('posts.index'));
    }
}
