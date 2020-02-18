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
}
