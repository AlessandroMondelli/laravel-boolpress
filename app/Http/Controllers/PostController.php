<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        $posts = Post::all(); //Prendo tutti i posts
        return view('posts',['posts'=>$posts]);
    }

    public function show($slug) {
        $post = Post::where('slug',$slug)->first();
        return view('choosen-post',['post' => $post]);
    }

    public function postCategoria($slug) {
        $category = Category::where('slug',$slug)->first(); //Recupero categoria
        if (!empty($category)) { //Se non è null
            $category_post = $category->posts; //Prendo categoria post
            return view('single-category',['category'=> $category, 'posts' => $category_post]);
        } else {
            return abort(404); //Se non trovo categorie, riporto un errore
        }
    }

    public function postTag($slug) {
        $tag = Tag::where('slug',$slug)->first(); //Recupero tag
        if (!empty($tag)) { //Se non è null
            $post_tag = $tag->posts; //Prendo tag post
            return view('single-tag',['tag'=> $tag, 'posts' => $post_tag]);
        } else {
            return abort(404); //Se non trovo tag, riporto un errore
        }
    }
}
