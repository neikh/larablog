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
                                <a href="/admin/media" class="px-xl-3 font-weight-bold">Media</a>
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
                        {{ $posts->links() }}
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
                                    <tr class="pointer" onclick="modal('post', {{$post->id}}); return false">
                                        <td class="text-center p-2">{{$post->id}}</td>
                                        <td class="p-2">{{$post->post_title}}</td>
                                        <td class="p-2">{{Custom::limit_text($post->post_content, 15)}}</td>
                                        <td class="text-center p-2">{{$post->post_status}}</td>
                                        <td class="text-center p-2">{{$post->post_name}}</td>
                                        <td class="text-center p-2">{{$post->post_type}}</td>
                                        <td class="text-center p-2">{{$post->post_category}}</td>
                                        <td class="text-center p-2">{!!Custom::dateWritter($post->post_date)!!}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $posts->links() }}
                    @endif

                    @if (isset($link) AND $link == "media")
                        <div>
                            <div>
                                <form action="/admin/media" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <div class="container my-xl-3">
                                        <div class="row justify-content-center">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-header">Media to upload</div>

                                                    <div class="card-body text-center">
                                                            <br />
                                                            <label for="image" class="pointer font-weight-bold">Click here to select a media</label>
                                                            <input type="file" id="image" name="image" style="display:none" onchange="mediaUpdate(this); return false" />
                                                            <br /><span id="displayer">No file loaded yet...</span><br />
                                                            <input type="submit" name="valide" value="Save" />
                                                            <br /><br />
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            @if(isset($files))
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">My media</div>

                                                <div class="card-body">
                                                    <table class="table-bordered table-striped justify-content-center mx-xl-auto">
                                                        <tbody>
                                                            @foreach ($files as $file)
                                                                <tr id="{{ $file }}" class="moveLeft">
                                                                    <td><img src="{{ asset('storage/thumb/'.$file) }}" /></td>
                                                                    <td class="align-top px-xl-3">
                                                                        <span class="font-weight-bold">Name : </span>{{ $file }}<br />
                                                                        <span class="font-weight-bold">Size : </span>{{ floor(filesize('storage/'.$file)/1000) }}ko<br />
                                                                        <span class="font-weight-bold">Appear in : </span>
                                                                            <div class="px-xl-3">
                                                                                Articles which use this picture will appear here.
                                                                            </div>

                                                                    </td>
                                                                    <td><i class="fas fa-edit display-2 px-xl-3 pointer"></i></td>
                                                                    <td><i class="far fa-trash-alt display-2 px-xl-3 pointer" onclick="remove('{{$file}}', 'media')"></i></td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif

                    @if(isset($users))
                        {{ $users->links() }}
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
                                        <td class="text-center p-2">{!!Custom::dateWritter($user->email_verified_at)!!}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $users->links() }}
                    @endif

                    @if(isset($comments))
                        {{ $comments->links() }}
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
                                        <td class="p-2">{{Custom::limit_text($comment->comment_content, 15)}}</td>
                                        <td class="p-2">{!!Custom::dateWritter($comment->comment_date)!!}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $comments->links() }}
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
                        <form id="contentUpdater" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="patch"/>

                            <div class="form-group">
                                <label for="id" class="pointer d-lg-block font-weight-bold"><span>Article ID</span>
                                    <input type="number" class="form-control {{ $errors->has('id') ? 'is-invalid' : '' }}" name="id" id="id" placeholder="0"
                                    value="{{ old('id') }}" readonly> {!! $errors->first('id', '<div class="invalid-feedback">:message</div>') !!}
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="post_title" class="pointer d-lg-block font-weight-bold"><span>Article Title</span>
                                    <input type="text" class="form-control {{ $errors->has('post_title') ? 'is-invalid' : '' }}" name="post_title" id="post_title" placeholder="Article's title"
                                        value="{{ old('post_title') }}"> {!! $errors->first('post_title', '<div class="invalid-feedback">:message</div>') !!}
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="post_content" class="pointer d-lg-block font-weight-bold"><span>Article Content</span>
                                    <textarea class="form-control {{ $errors->has('post_content') ? 'is-invalid' : '' }}" name="post_content" id="post_content" placeholder="The article's content">{{ old('post_content') }}</textarea>
                                    {!! $errors->first('post_content', '<div class="invalid-feedback">:message</div>') !!}
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="post_status" class="pointer d-lg-block font-weight-bold"><span>Article Status</span>
                                    <input type="text" class="form-control {{ $errors->has('post_status') ? 'is-invalid' : '' }}" name="post_status" id="post_status" placeholder="The article's status"
                                    value ="{{ old('post_status') }}"> {!! $errors->first('post_status', '<div class="invalid-feedback">:message</div>') !!}
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="post_name" class="pointer d-lg-block font-weight-bold"><span>Article Name</span>
                                    <input type="text" class="form-control {{ $errors->has('post_name') ? 'is-invalid' : '' }}" name="post_name" id="post_name" placeholder="The article's name"
                                    value ="{{ old('post_name') }}">{!! $errors->first('post_name', '<div class="invalid-feedback">:message</div>') !!}
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="post_type" class="pointer d-lg-block font-weight-bold"><span>Article Type</span>
                                    <input type="text" class="form-control {{ $errors->has('post_type') ? 'is-invalid' : '' }}" name="post_type" id="post_type" placeholder="The article's type"
                                    value ="{{ old('post_type') }}">{!! $errors->first('post_type', '<div class="invalid-feedback">:message</div>') !!}
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="post_category" class="pointer d-lg-block font-weight-bold"><span>Article Category</span>
                                    <input type="text" class="form-control {{ $errors->has('post_category') ? 'is-invalid' : '' }}" name="post_category" id="post_category" placeholder="The article's category"
                                    value ="{{ old('post_category') }}">{!! $errors->first('post_category', '<div class="invalid-feedback">:message</div>') !!}
                                </label>
                            </div>

                            <button type="submit" class="btn btn-secondary">Update</button> <button class="btn btn-danger" onclick="remove(document.getElementById('id'), 'post'); return false">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endauth
    <script type="text/javascript" src="{!! asset('js/custom.js') !!}"></script>
    <audio>
        <source src="/musique/loop.mp3"></source>
    </audio>
    <a href="#app" id="backToTop" class="anchorLink" onclick="joke(this); return false"><i class="fas fa-arrow-alt-circle-up display-4"></i></a>
@endSection
