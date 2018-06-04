<?php

namespace App;

use Carbon\Carbon;

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

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    function isDraft(){
        return true;
    }

    function isMine(User $user){
        return $this->user_id === $user->id;
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

    public function scopeFilter($query, $filters)
    {
        if ( isset($filters['month']) ){
            if ( $month = $filters['month'] ) {
                $query->whereMonth('created_at', Carbon::parse($month)->month);
            }
        }

        if ( isset($filters['year']) ){
            if ( $year = $filters['year'] ) {
                $query->whereYear('created_at', $year);
            }
        }
    }

    public static function archives()
    {
        return static::selectRaw('year(created_at) as year, monthname(created_at) as month, count(*) numberOfPosts')
            ->orderByRaw('min(created_at) desc')
            ->groupBy('year', 'month')
            ->get();
    }
}
