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
        <div class="row justify-content-center col-md-12">
            <div>

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
                                <td>Date</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
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
                <table class="table-bordered table-striped">
                    <thead class="text-center font-weight-bold">
                        <tr>
                            <td class="p-2">ID</td>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Verified At</td>
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
                <table class="table-bordered table-striped">
                    <thead class="text-center font-weight-bold">
                        <tr>
                            <td class="p-2">ID</td>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Content</td>
                            <td>Date</td>
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
    @endauth
@endsection
