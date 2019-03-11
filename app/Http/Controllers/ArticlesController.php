<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index()
    {
        $posts = \App\Post::orderby('id_post', 'DESC')->get();
        return view('home', [
            'posts' => $posts,
        ]);
    }

    public function show($post_name)
    {
        $post = \App\Post::where('post_name', $post_name)->first();
        $user = \App\User::where('id', $post->post_author)->first();
        $comments = \App\Comment::where('post_id', $post->id)->get();

        return view('single', [
            'post' => $post,
            'user' => $user,
            'comments' => $comments,
        ]);
    }

}
