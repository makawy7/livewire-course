<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class MusicSearch extends Component
{
    public $results = [];
    public $search;

    public function updatedSearch()
    {
        if (strlen($this->search) > 2) {
            $response = Http::get('https://itunes.apple.com/search/?term=' . $this->search . '&limit=10');
            $this->results = $response['results'];
        }
    }
    public function render()
    {
        return view('livewire.music-search');
    }
}
