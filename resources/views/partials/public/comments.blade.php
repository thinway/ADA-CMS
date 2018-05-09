<div class="comments">
    <h3>Comments</h3>
    <div>
        <div class="card-block">
            <form action="/posts/{{ $post->id }}/comments" method="post">
                {{ csrf_field() }}
                @guest
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <input type="email" name="email" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="Email" value="{{ old('email') }}" required>
                            @if( $errors->has('email') )
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-lg-6">
                            <input type="name" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Name" value="{{ old('name') }}" required>
                            @if( $errors->has('name') )
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                    </div>
                @endguest
                <div class="form-group">
                    <textarea class="form-control {{ $errors->has('message') ? 'is-invalid' : '' }}" name="message" id="message" placeholder="Your comment here" required>{{ old('message') }}</textarea>
                    @if( $errors->has('message') )
                        <div class="invalid-feedback">
                            {{ $errors->first('message') }}
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
                <p><strong>{{ $comment->created_at->diffForHumans() }}</strong> by <strong>{{ $comment->name }}</strong> </p>
                <p>
                    {{ $comment->message }}
                </p>
            </li>
        @endforeach
    </ul>

</div>