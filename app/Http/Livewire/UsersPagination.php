<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersPagination extends Component
{
    use WithPagination;
    public $search;

    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        return view('livewire.users-pagination', [
            'users' => User::filter($this->search)->paginate(10)
        ]);
    }
}
