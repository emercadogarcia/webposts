<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;

use App\Http\Requests\PostRequest;

use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        //debuguear==    dd($request->all());
        //salvar o guardar
        $post = Post::create([
            'user_id' => auth()->user()->id
        ] + $request->all() );

        //sin crear el PostRequest
        // $request->validate([

        //     'title'=>'required|min:3|max:20',
        //     'file' =>'image|mimes:jpg,jpeg,gif,png,svg|max:2048',
        //     'body' =>'required'
        //     //'iframe'=>'required'

        // ])

        //Image   === recordar que $request trae todos los datos del formulario.
        if ($request->file('file')) {
            //Lo que hacemos es guardar la ubicacion del archivo, el archivo se guarda en la carpeta \posts\public eso lo hace la siguiente linea:
            $post->image = $request->file('file')->store('posts', 'public');
            $post->save();
        }

        //retornar
        return back()->with('status','Creado con Existo...');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    // public function show(Post $post)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {

        $post->update($request->all());

        if ($request->file('file')) {
            if($post->image !="") {
                //elininar imagen
                Storage::disk('public')->delete($post->image);
            }
            //luego se guarda
            $post->image = $request->file('file')->store('posts', 'public');
            $post->save();
        }

        return back()->with('status', 'Actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

        if($post->image==""){
            $post->delete();
        }else{
            //eliminacion de imagen
            Storage::disk('public')->delete($post->image);
            $post->delete();//eliminamos post de la bd
        }

        return back()->with('status', 'Eliminado con éxito.');
    }
}
