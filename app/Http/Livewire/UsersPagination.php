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
    public $sortField;
    public $sortAsc = true;
    protected $queryString = ['search', 'active', 'sortField', 'sortAsc'];
    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function updatedActive()
    {
        $this->resetPage();
    }

    public function updatedSortField()
    {
        $this->resetPage();
    }

    public function sort($field)
    {
        if ($this->sortField == $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }
    public function render()
    {
        return view('livewire.users-pagination', [
            'users' => User::filter([
                'search' => $this->search,
                'active' => $this->active
            ])->when($this->sortField, fn ($query, $field) =>
            $query->orderBy($field, $this->sortAsc ? 'asc' : 'desc'))->paginate(10)
        ]);
    }
}
