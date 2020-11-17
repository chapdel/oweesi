<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class Contacts extends LivewireDatatable
{
    public $perPage = 50;
    public $list;
    public function builder()
    {
        return Contact::where('list_id', $this->list->id)->orderBy("created_at", 'DESC');
    }

    public function columns()
    {
        return [
            Column::name('email')->label("Email")
                ->searchable(),
            //NumberColumn::name('subscribers')->label('Subscribers'),
        ];
    }
}
