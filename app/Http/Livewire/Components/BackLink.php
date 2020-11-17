<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class BackLink extends Component
{
    public $label = "Back";
    public $route;
    public function render()
    {
        return view('livewire.components.back-link');
    }
}
