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
