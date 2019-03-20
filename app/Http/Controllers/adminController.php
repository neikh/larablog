<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }

    public function index()
    {
        return view('admin');
    }

    public function articles(){
        $postCount = \App\Post::where('post_type','article')->orderby('id', 'DESC')->count();
        $posts = \App\Post::where('post_type','article')->orderby('id', 'DESC', $postCount)->paginate(25);

        return view('admin',[
            'posts' => $posts,
        ]);
    }

    public function users(){
        $userCount = \App\User::orderby('id', 'DESC')->count();
        $users = \App\User::orderby('id', 'DESC', $userCount)->paginate(25);

        return view('admin',[
            'users' => $users,
        ]);
    }

    public function comments(){
        $commentCount = \App\Comment::orderby('id', 'DESC')->count();
        $comments = \App\Comment::orderby('id', 'DESC', $commentCount)->paginate(25);

        return view('admin',[
            'comments' => $comments,
        ]);
    }

    public function media(){

        $mediaCount = \App\Post::where('post_type','media')->orderby('id', 'DESC')->count();
        $media = \App\Post::where('post_type','media')->orderby('id', 'DESC', $mediaCount)->paginate(25);
        $link = "media";

        return view('admin',[
            'medias' => $media,
            'link' => $link,
        ]);

    }

    public function display($type, $id){
        if ($type == "post"){
            $post = \App\Post::where('id', $id)->get();

            return json_encode($post);
        }
    }

    public function delete($type, $id){
        if ($type == "post"){
            $posts = \App\Post::where('id', $id)->get();
            $comments = \App\Comment::where('post_id', $id)->get();

            foreach($comments as $comment){
                $comment->delete();
            }

            foreach($posts as $post){
                $post->delete();
            }
        }
    }

    public function update(Request $request){

        $post = \App\Post::findOrFail($request->id);

        $post->id = $request->id;
        $post->post_title = $request->post_title;
        $post->post_content = $request->post_content;
        $post->post_status = $request->post_status;
        $post->post_name = $request->post_name;
        $post->post_type = $request->post_type;
        $post->post_category = $request->post_category;

        $post->save();

        return $this->articles();

    }
}
