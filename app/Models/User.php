<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'avatar_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function isAdmin()
    {
        return in_array($this->role_id, [1, 2]);
    }

    // Relationships:

    // Relacion Uno a Muchos inversa con Avatars 
    public function avatar()
    {
        return $this->belongsTo(Avatar::class);
    }

    // Relacion Uno a Muchos inversa con Roles 
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Relacion Uno a Muchos con Posts
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // Relacion Uno a Muchos con comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Relacion Uno a Muchos con comments
    public function commentReplies()
    {
        return $this->hasMany(CommentReply::class);
    }
}
