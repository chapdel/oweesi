<?php

namespace App\Http\Livewire\Form;

use App\Models\Lists;
use Livewire\Component;

class CreateLists extends Component
{
    public $title;
    public $description;

    protected $rules = [
        'title' => 'required|min:3',
    ];

    public function render()
    {
        return view('livewire.form.create-lists');
    }

    public function createList()
    {
        $this->validate();
        $list =   Lists::create([
            'title' => $this->title,
            'description' => $this->description,
            'uid' => Lists::uid(),
            'user_id' => auth()->id()
        ]);

        $this->emit('listAdded');

        $this->title = null;
        $this->description = null;
    }
}
