<?php

namespace App\Models\Traits;


trait CommentsJoins{
    // --------- Scopes ----------
    public function scopeJoinPostAndUser($query)
    {
        return $query->joinPosts()->joinUsers();
    }

    public function scopeJoinPosts($query, $fields = [])
    {
        if (count($fields) == 0) {
            return $query->join('posts', 'comments.post_id', '=', 'posts.id');
        }

        $select = ['comments.*'];

        foreach ($fields as $field) {
            $select[] = "posts.{$field} as post_{$field}";
        }

        return $query->join('posts', 'comments.post_id', '=', 'posts.id')->select($select);
    }

    public function scopeJoinUsers($query, $fields = [])
    {
        if (count($fields) == 0) {
            return $query->join('users', 'comments.user_id', '=', 'users.id');
        }

        $select = ['comments.*'];

        foreach ($fields as $field) {
            $select[] = "users.{$field} as user_{$field}";
        }

        return $query->join('users', 'comments.user_id', '=', 'users.id')->select($select);
    }

    public function scopePublishedPost($query)
    {
        return $query->where('posts.status', 'PUBLICADO');
    }
}