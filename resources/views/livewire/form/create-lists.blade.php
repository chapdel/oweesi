<div>
    {{-- In work, do what you enjoy. --}}
     <x-jet-form-section submit="createList">
    <x-slot name="title">
        {{ __('Create List') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Provide information of your new list.') }}
    </x-slot>

    <x-slot name="form">
        
        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('Title') }}" />
            <x-jet-input id="title" type="text" class="mt-1 block w-full" wire:model.defer="title" autocomplete="title" />
            <x-jet-input-error for="title" class="mt-2" />
        </div>

        <!-- Description -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="description" value="{{ __('Description') }}" />
            <textarea class="mt-1 block form-input rounded-md shadow-sm w-full" wire:model.defer="description" rows="3"></textarea>
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="listAdded">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
</div>
