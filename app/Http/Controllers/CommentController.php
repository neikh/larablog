<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(CommentRequest $request){

        $comment = null;
        if($request->id > 0) { $comment = \App\Comment::findOrFail($request->id); }
        else {
            $comment = new \App\Comment;
        }

        $comment->post_id = $request->post_id;
        $comment->comment_name = Auth::user()->name;
        $comment->comment_email = Auth::user()->email;
        $comment->comment_content = $request->comment_content;
        $comment->comment_date = date('Y-m-d H:i:s');
        $comment->save();

        $post = \App\Post::where('id', $request->post_id)->first();

        return redirect('articles/'.$post->post_name.'/');

    }

    public function delete($post_name, $id){

        $comment = \App\Comment::findOrFail($id);

        if ($comment->comment_name == Auth::user()->name){
            $comment->delete();
        }
        return redirect('articles/'.$post_name.'/');
    }

    public function update(Request $request, $post_name, $id){

        $comment = \App\Comment::findOrFail($id);
        $comment->comment_content = $request->label;
        $comment->save();
    }
}
