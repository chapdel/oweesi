<?php

namespace App\Listeners;

use App\Models\Lists;
use Illuminate\Auth\Events\Registered;
use Spatie\Permission\Models\Role;

class GiveRoleToNewUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $event->user->assignRole(Role::findByName('user'));
        $event->user->lists()->create([
            'title' => 'Default',
            'description' => 'Your default contact list',
            'uid' => Lists::uid()
        ]);
    }
}
