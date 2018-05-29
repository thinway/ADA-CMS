@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row main-area">
            <div class="col-md-3">
                @include('admin.partials.main_admin_panel_nav')
            </div>
            <div class="col-md-9">
                <nav aria-label="Page navigation example">
                    {{ $posts->appends(request()->query())->links() }}
                </nav>

                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th>Id</th>
                        <th>Author</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Tools</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr @if($post->isMine(Auth::user())) class="table-active" @endif>
                            <th scope="row">{{ $post->id }}</th>
                            <th>{{ $post->user->name }}</th>
                            <th>{{ $post->title }}</th>
                            <th>{{ $post->status }}</th>
                            <th><a href="{{ route('posts.edit', ['slug' => $post->slug]) }}">Edit</a></th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <nav aria-label="Page navigation example">
                    {{ $posts->appends(request()->query())->links() }}
                </nav>
            </div>
        </div>
    </div>
@endsection
