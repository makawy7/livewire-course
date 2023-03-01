<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SortIcon extends Component
{
    public $sortAsc;
    public function __construct($sortAsc)
    {
        $this->sortAsc = $sortAsc;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sort-icon');
    }
}
