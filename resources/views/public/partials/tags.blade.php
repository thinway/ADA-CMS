<div class="tags">
    @foreach($post->tags->pluck('name')->toArray() as $tag)
        <span class="badge badge-info">{{ $tag }}</span>
    @endforeach
</div>