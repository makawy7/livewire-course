<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostEdit extends Component
{
    public $post;
    public $successMessage;
    public function mount(Post $post)
    {
        $this->post = $post;
    }
    public function render()
    {
        return view('livewire.post-edit');
    }
}
