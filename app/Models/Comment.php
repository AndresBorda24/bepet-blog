<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\CommentsJoins;

class Comment extends Model
{
    use HasFactory;
    use CommentsJoins;

    protected $fillable = [
        'body',
        'user_id',
        'post_id'
    ];

    // -------- Relationships ---------

    // Relacion Uno a Muchos inversa con user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relacion Uno a Muchos Inversa con Posts
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // Relacion Uno a Muchos con CommentReplies
    public function replies()
    {
        return $this->hasMany(CommentReply::class);
    }
}
