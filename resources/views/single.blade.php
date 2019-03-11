@extends('layouts.single')

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
            <div class="card-header text-center font-weight-bold">{{ $post->post_title }}</div>
            <div class="card-body">
            {{ $post->post_content }}
            </div>
            <div class="card-footer">
                By <span class="font-weight-bold">{{$user->name}}</span>, the {{$post->created_at}}
                @if ($post->created_at != $post->updated_at)
                    , (last update the {{$post->updated_at}})
                @endif
            </div>
        </div>
    </div>

@endsection


@section('displayCom')

    <div class="col-md-12">
        <div class="card">
            <div class="card-header text-center font-weight-bold">Comment Area</div>
        </div>
        @foreach ($comments as $comment)
            <div class="card">
                <div class="card-body">
                {{ $comment->comment_content }}
                </div>
                <div class="card-footer">
                    By <span class="font-weight-bold">{{$comment->comment_name}}</span>, the {{$comment->created_at}}
                    @if ($comment->created_at != $comment->updated_at)
                        , (last edition the {{$comment->updated_at}})
                    @endif
                </div>
            </div>
        @endforeach
    </div>

@endsection
