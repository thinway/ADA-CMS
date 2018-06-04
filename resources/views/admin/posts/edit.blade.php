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

                    @include('admin.partials.post_form')

                    <button type="submit" class="btn btn-primary">Edit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

