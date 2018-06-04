@extends('public.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="articles col-9">
                <h1>Publish a Post</h1>

                <form method="POST" action="/admin/posts">
                    {{ csrf_field() }}

                    @include('admin.partials.post_form')

                    <button type="submit" class="btn btn-primary">Publish</button>
                </form>
            </div>

            @include('public.partials.sidebar')
        </div>
    </div>
@endsection