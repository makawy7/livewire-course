<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostEdit extends Component
{
    public $post;
    public $title;
    public $content;
    public $successMessage;

    public $rules = [
        'title' => 'required',
        'content' => 'required'
    ];
    public function mount(Post $post)
    {
        $this->post = $post;
        $this->title = $post->title;
        $this->content = $post->content;
    }
    public function render()
    {
        return view('livewire.post-edit');
    }

    public function editPost()
    {
        $this->validate();
        $this->post->update([
            'title' => $this->title,
            'content' => $this->content,
        ]);
        $this->successMessage = 'Post has been updated successfully.';
    }
}
