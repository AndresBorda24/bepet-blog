<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    use HasFactory;

    protected $table = 'CommentReplies';

    protected $fillable = [
        'body'
    ];

    // relacion Uno a Muchos Inversa Con Comments
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    // relacion Uno a Muchos Inversa Con users
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
