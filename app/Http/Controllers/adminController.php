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

    public static function media(){

        $link = "media";
        $files = \Storage::disk('public')->files();

        foreach($files as $file){

            if (!\Storage::exists('thumb/'.$file)) {
                \File::copy(base_path('storage/app/public/'.$file),base_path('storage/app/public/thumb/'.$file));
                $img = \Image::make(base_path('storage/app/public/thumb/'.$file))->resize(150, 100)->save(base_path('storage/app/public/thumb/'.$file));
            }

        }

        return view('admin',[
            'link' => $link,
            'files' => $files,
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
