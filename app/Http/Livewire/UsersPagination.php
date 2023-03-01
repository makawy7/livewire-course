<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersPagination extends Component
{
    use WithPagination;
    public $search;
    public $active;

    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function updatedActive()
    {   
        $this->resetPage();
    }
    public function render()
    {
        return view('livewire.users-pagination', [
            'users' => User::filter([
                'search' => $this->search,
                'active' => $this->active
            ])->paginate(10)
        ]);
    }
}
