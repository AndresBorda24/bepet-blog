<?php

namespace App\Http\Livewire\Post;

use App\Models\Comment;
use Livewire\Component;

class CreateComments extends Component
{
    public $body, $commentedPost;

    protected $rules = [
        'body' => ['required', 'min:5', 'max:255'],
    ];

    public function mount($commentedPost)
    {
        $this->commentedPost = $commentedPost;
    }

    public function updatedBody()
    {
        $this->validate();
    }

    public function createComment()
    {
        $this->validate();

        Comment::create([
            'body' => $this->body,
            'user_id' => auth()->id(),
            'post_id' => $this->commentedPost
        ]);
        
        $this->reset('body');
        $this->emit('render');
    }

    public function render()
    {
        return view('livewire.post.create-comments');
    }
}
