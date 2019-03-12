@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="text-center">
               Don't you love when the&nbsp;<a href="/admin">admin</a>&nbsp;part is in plain sight?
            </div>
        </div>
    </div>
@endsection

@section('displayData')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">{{$posts->count()}} Most Recents Articles</div>
        <div class="card-body">
            <ul>
                @if(isset($posts) && $posts->count() > 0)
                    @foreach ( $posts as $post )
                        <li><a href="/articles/{{ $post->post_name }}/">{{ $post->post_title }}</a></li>
                    @endforeach
                @else
                    <li>No articles yet...</li>
                @endif
            </ul>
        </div>
    </div>
</div>

@endsection
