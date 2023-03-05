<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostEdit extends Component
{
    use WithFileUploads;
    public $post;
    public $title;
    public $content;
    public $successMessage;
    public $photo;

    public $rules = [
        'title' => 'required',
        'content' => 'required',
        'photo' => 'nullable|sometimes|image|max:10024'
    ];
    public function mount(Post $post)
    {
        $this->post = $post;
        $this->title = $post->title;
        $this->content = $post->content;
    }
    public function updatedPhoto()
    {
        $this->validateOnly('photo');
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
            'photo' => $this->photo ? $this->photo->store('posts', 'public') : $this->post->photo,
        ]);
        $this->successMessage = 'Post has been updated successfully.';
    }
}
