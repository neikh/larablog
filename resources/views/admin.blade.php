@extends('layouts.app')

@section('content')
    @auth
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Admin</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <p class='text-center'>Welcome to the <span class="font-weight-bold">admin panel</span>!</p>

                            <p class='text-center'>
                                <a href="/admin/articles" class="px-xl-3 font-weight-bold">Articles</a>
                                <a href="/admin/users" class="px-xl-3 font-weight-bold">Users</a>
                                <a href="/admin/comments" class="px-xl-3 font-weight-bold">Comments</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endauth
@endsection


@section('displayData')
    @auth
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">

                    @if(isset($posts))
                        {!!$pagination!!}
                        <table class="table-bordered table-striped justify-content-center">
                            <thead class="text-center font-weight-bold">
                                <tr>
                                    <td class="p-2">ID</td>
                                    <td>Title</td>
                                    <td>Content</td>
                                    <td>Status</td>
                                    <td>Name</td>
                                    <td>Type</td>
                                    <td>Category</td>
                                    <td width="120">Date</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr onclick="modal('post', {{$post->id}}); return false">
                                        <td class="text-center p-2">{{$post->id}}</td>
                                        <td class="p-2">{{$post->post_title}}</td>
                                        <td class="p-2">{{$post->limit_text($post->post_content, 15)}}</td>
                                        <td class="text-center p-2">{{$post->post_status}}</td>
                                        <td class="text-center p-2">{{$post->post_name}}</td>
                                        <td class="text-center p-2">{{$post->post_type}}</td>
                                        <td class="text-center p-2">{{$post->post_category}}</td>
                                        <td class="text-center p-2">{!!$post->dateWritter($post->post_date)!!}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!!$pagination!!}
                    @endif

                    @if(isset($users))
                        {!!$pagination!!}
                        <table class="table-bordered table-striped justify-content-center">
                            <thead class="text-center font-weight-bold">
                                <tr>
                                    <td class="p-2">ID</td>
                                    <td>Name</td>
                                    <td>Email</td>
                                    <td width="120">Verified At</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="text-center p-2">{{$user->id}}</td>
                                        <td class="p-2">{{$user->name}}</td>
                                        <td class="p-2">{{$user->email}}</td>
                                        <td class="text-center p-2">{!!$user->dateWritter($user->email_verified_at)!!}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!!$pagination!!}
                    @endif

                    @if(isset($comments))
                        {!!$pagination!!}
                        <table class="table-bordered table-striped justify-content-center">
                            <thead class="text-center font-weight-bold">
                                <tr>
                                    <td class="p-2">ID</td>
                                    <td>Name</td>
                                    <td>Email</td>
                                    <td>Content</td>
                                    <td width="120">Date</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($comments as $comment)
                                    <tr>
                                        <td class="text-center p-2">{{$comment->id}}</td>
                                        <td class="p-2">{{$comment->comment_name}}</td>
                                        <td class="p-2">{{$comment->comment_email}}</td>
                                        <td class="p-2">{{$comment->limit_text($comment->comment_content, 15)}}</td>
                                        <td class="p-2">{!!$comment->dateWritter($comment->comment_date)!!}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!!$pagination!!}
                    @endif
                </div>
            </div>
        </div>
    @endauth
@endsection

@section('switch')
     @auth
        <div id="bgmodal">
            <div id="modal">
                <div id="modalContent">
                    <a href="#" id="close" onclick="modal('remove'); return false">Fermer</a>
                    <br />
                    <?php
                        $url = str_replace('/index.php', '', $_SERVER['PHP_SELF']);
                    ?>

                    <div class="col-md-8 text-center container">
                        <form action="{{ $url }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="number" class="form-control {{ $errors->has('id') ? 'is-invalid' : '' }}" name="id" id="id" placeholder="0"
                                    value="{{ old('id') }}" disabled> {!! $errors->first('id', '
                                <div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control {{ $errors->has('post_title') ? 'is-invalid' : '' }}" name="post_title" id="post_title" placeholder="Article's title"
                                    value="{{ old('post_title') }}"> {!! $errors->first('post_title', '
                                <div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                <textarea class="form-control {{ $errors->has('post_content') ? 'is-invalid' : '' }}" name="post_content" id="post_content" placeholder="The article's content">{{ old('post_content') }}</textarea>
                                {!! $errors->first('post_content', '
                                <div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control {{ $errors->has('post_status') ? 'is-invalid' : '' }}" name="post_status" id="post_status" placeholder="The article's status"
                                value ="{{ old('post_status') }}">
                                {!! $errors->first('post_status', '
                                <div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control {{ $errors->has('post_name') ? 'is-invalid' : '' }}" name="post_name" id="post_name" placeholder="The article's name"
                                value ="{{ old('post_name') }}">
                                {!! $errors->first('post_name', '
                                <div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                    <input type="text" class="form-control {{ $errors->has('post_type') ? 'is-invalid' : '' }}" name="post_type" id="post_type" placeholder="The article's type"
                                    value ="{{ old('post_type') }}">
                                    {!! $errors->first('post_type', '
                                    <div class="invalid-feedback">:message</div>') !!}
                                </div>
                            <div class="form-group">
                                <input type="text" class="form-control {{ $errors->has('post_category') ? 'is-invalid' : '' }}" name="post_category" id="post_category" placeholder="The article's category"
                                value ="{{ old('post_category') }}">
                                {!! $errors->first('post_category', '
                                <div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <button type="submit" class="btn btn-secondary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endauth
    <script type="text/javascript" src="{!! asset('js/custom.js') !!}"></script>
@endSection
