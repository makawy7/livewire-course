<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UsersPagination extends Component
{   
    public function render()
    {   
        return view('livewire.users-pagination', [
            'users' => User::paginate(10)
        ]);
    }
}
