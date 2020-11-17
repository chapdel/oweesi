<?php

namespace App\Http\Livewire;

use App\Models\Lists as ModelsLists;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class Lists extends LivewireDatatable
{
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
            Column::callback(['uid'], function ($uid) {
                return view('livewire.components.btn-action', ['route' => route('lists.show', $uid), 'type' => 'btn-link', 'label' => "View"]);
            })->alignRight()
            //NumberColumn::name('contacts:count')->label('Student Max'),
            //Column::name("actions")->label("")->view('components.btn-action', ['route' => route('units.show', $model->uid), 'type' => 'btn-link', 'label' => "View"])
        ];
    }
}
