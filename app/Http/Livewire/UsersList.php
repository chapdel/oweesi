<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class UsersList extends LivewireDatatable
{
    public function builder()
    {
        return User::orderBy("created_at", 'DESC');
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID'),
            Column::name('name')->label("Name")
                ->searchable(),
            Column::name('email')->label("Email")
                ->searchable(),
            BooleanColumn::name('email_verified_at')
                ->label('Verified'),

        ];
    }

    /* public function render()
    {
        return view('livewire.users-list');
    } */
}
