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

    public function articles($p = 1){
        $offset = $p * 25 - 25;
        $posts = \App\Post::orderby('id', 'DESC')->offset($offset)->limit(25)->get();
        $postCount = \App\Post::orderby('id', 'DESC')->count();
        $pagination = $this->pagination($p , $postCount);

        return view('admin',[
            'posts' => $posts,
            'pagination' => $pagination,
        ]);
    }

    public function users($p = 1){
        $offset = $p * 25 - 25;
        $users = \App\User::orderby('id', 'DESC')->offset($offset)->limit(25)->get();
        $userCount = \App\User::orderby('id', 'DESC')->count();
        $pagination = $this->pagination($p , $userCount);

        return view('admin',[
            'users' => $users,
            'pagination' => $pagination,
        ]);
    }

    public function comments($p = 1){
        $offset = $p * 25 - 25;
        $comments = \App\Comment::orderby('id', 'DESC')->offset($offset)->limit(25)->get();
        $commentCount = \App\Comment::orderby('id', 'DESC')->count();
        $pagination = $this->pagination($p , $commentCount);

        return view('admin',[
            'comments' => $comments,
            'pagination' => $pagination,
        ]);
    }

    public function pagination($p = 1, $element = 25, $perPage = 25){

		$neatURL = explode("/", $_SERVER["REQUEST_URI"]);

		$url = '/';
		foreach ($neatURL as $u){
			if ($u != $p){
				$url .= $u."/";
			}
		}
		$url = str_replace('//', '/', $url);

		$pages = ceil($element / $perPage);
		$write = '';

		$write .= '<div class="pagination text-center m-xl-4">';

        $q = $p - 1;
        $r = $p + 1;

        $write .= '<a href="'.$url.'1/" class="page-link"><<</a>';

        if ($q > 0){
            $write .= "<a href='".$url."".$q."/' class='page-link'>prev</a>";
        } else {
            $write .= "<a class='page-link'>prev</a>";
        }

        $low = $p - 3;
        $high = $p + 3;

        if ($low <= 1){
            $low = 1;
        } else {
            $write .= "<a class='page-link'>...</a>";
        }

        if ($high > $pages){
            $high = $pages;
        }

        for ($i = $low; $i <= $high; $i++){
            if ($i == $p){
                $write .= "<a href='".$url."".$i."/' class='page-link list-group-item.active'>".$i."</a>";
            } else {
                $write .= "<a href='".$url."".$i."/' class='page-link'>".$i."</a>";
            }
        }

        if ($high < $pages){
            $write .=  "<a class='page-link'>...</a>";
        }

        if ($r <= $pages){
            $write .=  "<a href='".$url."".$r."/' class='page-link'>next</a>";
        } else {
            $write .=  "<a class='page-link'>next</a>";
        }

        $write .=  "<a href='".$url."".$pages."/' class='page-link'>>></a>";
		$write .= '</div>';

		return $write;
	}
}
