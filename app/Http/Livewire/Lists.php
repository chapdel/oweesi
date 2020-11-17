<?php

namespace App\Http\Livewire;

use App\Models\Lists as ModelsLists;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class Lists extends LivewireDatatable
{
    public function builder()
    {
        return ModelsLists::orderBy("created_at", 'DESC');
    }

    public function columns()
    {
        return [
            Column::name('title')->label("Title")
                ->searchable(),
        ];
    }
}
