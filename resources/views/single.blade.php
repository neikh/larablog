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
                <div class="text-right">
                    @auth
                        @if (Auth::user()->name == $user->name)
                            <i class="fas fa-edit"></i>
                            <i class="far fa-trash-alt"></i>
                        @endif
                    @endauth
                </div>
            </div>
            <div class="card-footer">
                By <span class="font-weight-bold">{{$user->name}}</span>, the {{$post->created_at}}
                @if ($post->created_at != $post->updated_at)
                    , (last update the {{$post->updated_at}})
                @endif
            </div>
        </div>
    </div>
<br />

@endsection


@section('displayCom')
    <?php
        $url = str_replace('/index.php', '', $_SERVER['PHP_SELF']);
    ?>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header text-center font-weight-bold">Comment Area</div>
        </div>
        @foreach ($comments as $comment)
            <div class="card">
                <div class="card-body">

                    <textarea id="com_{{$comment->id}}" class="form-control bg-transparent border-0" name="comment_modif" onkeyup="writting({{$comment->id}}, '{{$post->post_name}}', event, this.value); return false" disabled>{{ $comment->comment_content }} {{ old('comment_modif') }}</textarea>
                    @auth
                        @if (Auth::user()->name == $comment->comment_name)
                            <div class="text-right">
                                <a href="#"><i class="fas fa-edit" onclick="editionMode(document.getElementById('com_{{$comment->id}}')); return false"></i></a>
                                <a href="{{ $url }}/delete/{{$comment->id}}"><i class="far fa-trash-alt"></i></a>
                            </div>
                        @endif
                    @endauth
                </div>
                <div class="card-footer">
                    By <span class="font-weight-bold">{{$comment->comment_name}}</span>, the {!!$comment->dateWritter($comment->created_at)!!}
                    @if ($comment->created_at != $comment->updated_at)
                        , last edition the {!!$comment->dateWritter($comment->updated_at)!!}
                    @endif

                </div>
            </div>
            <br />
        @endforeach
    </div>

@endsection

@section('postCom')
    <?php
        $url = str_replace('/index.php', '', $_SERVER['PHP_SELF']);
    ?>
    @auth
        <div class="col-md-8 text-center container">
            <span class="font-weight-bold">Add a wonderful Comment!</span>
            <form action="{{ $url }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                <input type="text" class="form-control {{ $errors->has('user_name') ? 'is-invalid' : '' }}" name="user_name" id="user_name" placeholder="{{ Auth::user()->name }}"
                        value="{{ old('user_name') }}" disabled> {!! $errors->first('user_name', '
                    <div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    <input type="email" class="form-control {{ $errors->has('user_email') ? 'is-invalid' : '' }}" name="user_email" id="user_email" placeholder="{{ Auth::user()->email }}"
                        value="{{ old('user_email') }}" disabled> {!! $errors->first('user_email', '
                    <div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    <textarea class="form-control {{ $errors->has('comment_content') ? 'is-invalid' : '' }}" name="comment_content" id="comment_content" placeholder="Votre message">{{ old('user_message') }}</textarea>                            {!! $errors->first('user_message', '
                    <div class="invalid-feedback">:message</div>') !!}
                </div>
                <input type="hidden" name="post_id" value="{{$post->id}}"/>
                <button type="submit" class="btn btn-secondary">Envoyer !</button>
            </form>
        </div>
    @else
        <div class="col-md-8 text-center container">
            <span class="font-weight-bold">The ability to troll in the comments is for registered users only.</span>
        </div>
    @endauth
@endsection

@section('switch')
    <script type="text/javascript" src="{!! asset('js/custom.js') !!}"></script>
@endSection
