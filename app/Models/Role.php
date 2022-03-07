<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['role'];

    public const IS_ADMIN = 1;
    public const IS_MANAGER = 2;
    public const IS_USER = 3;


    // Relacion Una a Muchos con usuarios
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
