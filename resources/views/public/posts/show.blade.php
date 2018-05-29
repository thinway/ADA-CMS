@extends('public.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="articles col-9">
                <div class="article">
                    <h2 class="card-title">{{ $post->title }}</h2>
                    <p class="blog-post-meta">{{ $post->created_at->toFormattedDateString() }}</p>
                    <img src="https://picsum.photos/800/300" alt="Picsum Pic" class="img-fluid">
                    <p class="excerpt">{{ $post->excerpt }}</p>
                    <p class="content">{{ $post->content }}</p>
                </div>
                <hr>
                @include('public.partials.comments')
            </div>
            @include('public.partials.sidebar')
        </div>
    </div>
@endsection
