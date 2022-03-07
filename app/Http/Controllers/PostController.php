<?php

namespace App\Http\Controllers;

use Laravel\Jetstream\Features;

use Illuminate\Http\Request;

use App\Models\Post;

use App\Models\User;

use Inertia\Inertia;

use Redirect;

use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return Inertia::render('Posts/index', ['posts' => $posts]);
    }

    /**
     *Display a listing of the resource.
     *  
     * @return \Inertia\Response
     */
    public function create(): \Inertia\Response
    {
        return Inertia::render('Posts/Create');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return Inertia::render('Posts/Update', [
            'post' => $post
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Redirect
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        
        $request->validate([
            'title' => 'required|string',
            'body'  => 'required|string'
        ]);

        

        Post::create([
            'title' => $request->title,
            'body'  => $request->body,
            'user_id' => $request->user_id
        ]);

        //return response("El post ha sido creado correctamente", 200);
        return Redirect::route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return response($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());
        $post->save();

        //return response("El post ha sido actualizado correctamente");
        return Redirect::route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::findOrfail($id)->delete();
        return response("El post ha sido eliminado correctamente");
    }
}
