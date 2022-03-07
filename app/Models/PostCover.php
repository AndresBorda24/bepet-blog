<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCover extends Model
{
    use HasFactory;

    protected $table = 'PostCovers';

    protected $fillable = [
        'link',
        'post_id'
    ];

    // Relacion uno a uno inversa con post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
