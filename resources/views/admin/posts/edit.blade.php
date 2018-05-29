@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row main-area">
            <div class="col-md-3">
                @include('admin.partials.main_admin_panel_nav')
            </div>
            <div class="col-md-9">
                <h1>Edit Post</h1>

                <form method="POST" action="{{ route('posts.patch', ['slug' => $post->slug ]) }}">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="title" name="title" value="{{ $post->title }}">
                        <small id="titleHelp" class="form-text text-muted">Enter the post title</small>
                        @if( $errors->has('title') )
                            <div class="invalid-feedback">
                                {{ $errors->first('title') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="excerpt">Excerpt</label>
                        <textarea class="form-control {{ $errors->has('excerpt') ? 'is-invalid' : '' }}" id="excerpt" name="excerpt" rows="3">{{ $post->excerpt }}</textarea>
                        <small id="titleHelp" class="form-text text-muted">Enter the post description</small>
                        @if( $errors->has('excerpt') )
                            <div class="invalid-feedback">
                                {{ $errors->first('excerpt') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" id="content" name="content" rows="10">{{ $post->content }}</textarea>
                        <small id="titleHelp" class="form-text text-muted">Enter the post content</small>
                        @if( $errors->has('content') )
                            <div class="invalid-feedback">
                                {{ $errors->first('content') }}
                            </div>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary">Edit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

