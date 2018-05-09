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

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    function isDraft(){
        return true;
    }

    public static function scopePublished($query) {
        return $query->where('status', 'published');
    }



    public function addComment($message, $name, $email)
    {
        $this->comments()->create([
            'name' => $name,
            'email' => $email,
            'message' => $message
        ]);
    }
}
