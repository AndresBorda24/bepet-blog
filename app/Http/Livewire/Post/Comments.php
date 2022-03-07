<?php

namespace App\Http\Livewire\Post;

use App\Models\Comment;
use Livewire\Component;

class Comments extends Component
{
    public $comments, $postId;

    protected $listeners = ['render'];

    public function mount($postId)
    {
        $this->postId = $postId;
    }

    public function comments()
    {
        return Comment::where('post_id', $this->postId)
                        ->orderBy('created_at', 'desc')
                        ->with([
                            'user', 
                            'user.avatar',
                            'replies', 
                            'replies.user',  
                            'replies.user.avatar'
                        ])->get();
    }

    public function render()
    {
        return view('livewire.post.comments', [
            'comms' => $this->comments(),
            'post_id' => $this->postId
        ]);
    }
}
