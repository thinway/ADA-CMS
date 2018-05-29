@extends('public.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="articles col-9">

                <nav aria-label="Page navigation example">
                    {{ $posts->appends(request()->query())->links() }}
                </nav>

                @foreach($posts as $post)
                    <div class="article">
                        <h2 class="card-title"><a href="/posts/{{ $post->slug }}">{{ $post->title }}</a></h2>
                        <p class="blog-post-meta">{{ $post->created_at->toFormattedDateString() }}</p>
                        <img src="https://picsum.photos/800/300" alt="Picsum Pic" class="img-fluid">
                        <p class="excerpt">{{ $post->excerpt }}</p>
                        <a href="/posts/{{ $post->slug }}" class="btn btn-primary">Read more</a>
                    </div>
                @endforeach
                <nav aria-label="Page navigation example">
                    {{ $posts->appends(request()->query())->links() }}
                </nav>
            </div>
            @include('public.partials.sidebar')
        </div>
    </div>
@endsection
