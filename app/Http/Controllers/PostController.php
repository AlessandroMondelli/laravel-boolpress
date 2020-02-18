<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all(); //Prendo tutti i posts
        return view('posts',['posts'=>$posts]);
    }

    public function show($slug)
    {
        $post = Post::where('slug',$slug)->first();
        return view('choosen-post',['post' => $post]);
    }
}
