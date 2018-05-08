<?php

namespace App;

class Post extends Model
{
    /**
     * This method modify the field that route binding works with.
     * By default Route Binding works with 'id' field, but in this
     * case we've changed this value to 'slug'
     *
     * @return string The field that Route Binding works with.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    function isDraft(){
        return true;
    }

    public static function scopePublished($query) {
        return $query->where('status', 'published');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function addComment($body)
    {
        $this->comments()->create([
            'body' => $body
        ]);
//        Comment::create([
//            'body' => $body,
//            'post_id' => $this->id
//        ]);
    }
}
