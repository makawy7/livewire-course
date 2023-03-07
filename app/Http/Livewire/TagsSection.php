<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use Livewire\Component;
use Livewire\Livewire;

class TagsSection extends Component
{
    public $tags;
    protected $listeners = ['tagAdded', 'tagRemoved'];

    public function mount()
    {
        $this->tags = Tag::all()->pluck('name')->toJson();
    }
    public function tagAdded($tag)
    {
        Tag::create(['name' => $tag]);
        // emit from server and listen on the front-end
        $this->emit('added', $tag);
    }
    public function tagRemoved($tag)
    {
        Tag::where('name', $tag)->first()->delete();
    }
    public function render()
    {
        return view('livewire.tags-section');
    }
}
