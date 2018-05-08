@extends('layouts.app')

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
                <div class="comments">
                    <h3>Comments</h3>
                    <div >
                        <div class="card-block">
                            <form action="/posts/{{  $post->id }}/comments" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <textarea class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" name="body" id="body" placeholder="Your comment here" required>{{ old('body') }}</textarea>
                                    @if( $errors->has('body') )
                                        <div class="invalid-feedback">
                                            {{ $errors->first('body') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Comment</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <ul class="list-group">
                        @foreach( $post->comments as $comment)
                            <li class="list-group-item">
                                <strong>
                                    {{ $comment->created_at->diffForHumans() }}:
                                </strong>
                                {{ $comment->body }}
                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>
            @include('partials.public.sidebar')
        </div>
    </div>
@endsection
