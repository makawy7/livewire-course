<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;

class CommentSection extends Component
{
    public $successMessage;
    public $post;
    public $comment;
    public $rules = [
        'comment' => 'required|min:3'
    ];
    public function mount($post)
    {
        $this->post = $post;
    }

    public function addComment()
    {   
        $this->validate();
        Comment::create([
            'post_id' => $this->post->id,
            'username' => 'abdallah',
            'content' => $this->comment
        ]);
        $this->post = Post::with('comments')->find($this->post->id);
        $this->successMessage = 'Comment has been successfully added.';
        $this->comment = '';
    }
    public function render()
    {
        return view('livewire.comment-section');
    }
}
