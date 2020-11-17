<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use App\Models\Lists as ModelsLists;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class Lists extends LivewireDatatable
{
    public $perPage = 50;
    public function builder()
    {
        return ModelsLists::where('user_id', auth()->id())->orderBy("created_at", 'DESC');
    }

    public function columns()
    {
        return [
            Column::name('title')->label("Title")
                ->searchable(),
            Column::name('uid')->label("ID"),
            //NumberColumn::name('subscribers')->label('Subscribers'),
            Column::callback(['uid'], function ($uid) {
                return view('livewire.components.btn-action', ['route' => route('lists.show', $uid), 'type' => 'btn-link', 'label' => "View"]);
            })->alignRight()
        ];
    }
}
