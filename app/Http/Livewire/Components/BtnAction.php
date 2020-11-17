<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class BtnAction extends Component
{
    public $type = 'btn';
    public $route;
    public function render()
    {
        return view('livewire.components.btn-action');
    }
}
