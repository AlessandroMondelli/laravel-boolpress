<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
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
        $posts = Post::all(); //Prendo tutti i posts
        return view('admin.posts.index', ['posts'=>$posts]);
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all(); //prendo categorie per passarle alla create
        $tags = Tag::all(); //prendo tags per passarli alla create
        return view('admin.posts.create', ['categories' => $categories ,'tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validazione dati form
        $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'content' => 'required',
            'cover_image' => 'image|max:30000' //Max -> grandezza foto in kb
        ]);

        $form_data = $request->all(); //Prendo tutti i nuovi dati dal form
        // dd($form_data);
        $cover_image = $form_data['cover_image']; //Prendo dati dell'immagine
        // dd($cover_image);
        $image_path = Storage::put('uploads',$cover_image); //Prendo PATH dell'immagine dopo averlo preparato per l'upload
        // dd($image_path);
        $post = new Post(); //Creo nuovo elemento
        $post->cover_image = $image_path; //Assegno path dell'immagine

        $post->fill($form_data); //Riempio dati per db

        $original_slug = Str::slug($form_data['title']); //Creo slug dal titolo
        $temp_slug = $original_slug; //Metto da parte lo slug

        //Verifico se lo slug è già presente

        //tentativo con count non funzionante
        // $count_slug = Post::where('slug',$temp_slug)->where(\DB::raw('substr(slug, charindex(-, slug), len(slug))')->whereNotNull('slug')->count(); //Conto gli slug in caso siano uguali
        // if ($count_slug > 0) { //Se sono già presenti slug uguali..
        //     $temp_slug = $original_slug . '-' . $count_slug; //Aggiungo numero alla fine dello slug
        // }

        $post_same_slug = Post::where('slug',$temp_slug)->first(); //Cerco slug uguali
        $slug_found = 1; //contatore slug troati
        while(!empty($post_same_slug)) {
            $temp_slug = $original_slug . '-' . $slug_found; //Aggiungo numero alla fine dello slug
            $post_same_slug = Post::where('slug',$temp_slug)->first(); //Verifico se ne è presente un altro
            $slug_found++; //Aggiorno contatore
        }

        $post->slug = $temp_slug; //Aggiungo Slug
        $post->save(); //Salvo nel db

        if (!empty($dati['tag_id'])) {
            $post->tags()->sync($form_data['tag_id']); //Sincronizzo dati con database anche per i tags
        }

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show',['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all(); //prendo categorie per passarle alla Edit
        $tags = Tag::all(); //prendo tags per passarli alla Edit
        return view('admin.posts.edit',['post' => $post, 'categories' => $categories, 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //Validazione dati form
        $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'content' => 'required',
            'cover_image' => 'image|max:30000' //Max -> grandezza foto in kb
        ]);
        
        $form_data = $request->all(); //Prendo tutti i nuovi dati dal form

        if (!empty($form_data['cover_image'])) { //Se il cmpo dell'immagine non è vuoto..
            $cover_image = $form_data['cover_image']; //Prendo dati dell'immagine
            $image_path = Storage::put('uploads',$cover_image); //Prendo PATH dell'immagine dopo averlo preparato per l'upload
            $post->cover_image = $image_path; //Assegno path dell'immagine
        }

        $post->update($form_data); //Aggiorno dati

        if (!empty($dati['tag_id'])) {
            $post->tags()->sync($form_data['tag_id']); //Sincronizzo dati con database anche per i tags
        } else {
            $post->tags()->sync([]); //Se non vengono messe spunte, svuoto tags
        }


        return redirect()->route('admin.posts.index'); //Indirizzo all'index
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post_image = $post->cover_image; //Prendo Immagine
        if (!empty($post_image)) {
            Storage::delete($post_image); //Elimino immagine solo se presente
        }

        if ($post->tags->isNotEmpty()) {
            $post->tags()->sync([]); //Elimino tags se prensenti
        }

        $post->delete(); //Elimino dati
        return redirect()->route('admin.posts.index'); //Indirizzo all'index
    }
}
