<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        // get posts
        $posts = Post::latest()->paginate(5);

        // render view with post
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        // get posts
        $posts = Post::latest()->paginate(5);

        // render view with post
        return view('posts.create', compact('posts'));
    }
}
