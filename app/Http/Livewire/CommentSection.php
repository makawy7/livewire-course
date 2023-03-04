<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CommentSection extends Component
{
    public $successMessage;
    public $post;
    public function mount($post)
    {
        $this->post = $post;
    }
    public function render()
    {
        return view('livewire.comment-section');
    }
}
