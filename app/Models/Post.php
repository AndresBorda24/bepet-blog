<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'extract', 
        'body',
        'status',
        'slug',
        'posted_at',
        'user_id',
        'category_id'
    ];

    protected $with = ['cover'];


    protected static function booted()
    {
        static::deleting(function ($post) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($post->cover->link);
        });
    }

    public function getLimitExtractAttribute()
    {
        return substr($this->extract, 0, 40);
    }


    // Scopes
    public function scopePublished($query)
    {
        return $query->where('posts.status', 'PUBLICADO');
    }

    public function scopeAuthUser($query)
    {
        return $query->where('user_id', auth()->id());
    }

    public function scopeLastWeek($query)
    {
        return $query->whereBetween('posted_at', [now()->subWeek(), now()]);
    }

    public function scopeLatestPublished($query)
    {
        return $query->orderBy('posted_at', 'desc');
    }

    public function scopeJoinUser($query)
    {
        return $query->join('users', 'user_id', '=', 'users.id');
    }

    // ---------Relationships----------

    // Relacion uno a Muchos inversa con Users
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relacion Uno a Muchos con Comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Relacion Uno a Muchos Inversa con Categories
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relacion uno a uno con PostCovers
    public function cover()
    {
        return $this->hasOne(PostCover::class);
    }

    // Relacion Muchos a Muchos Inversa
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
