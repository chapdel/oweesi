<x-app-layout>
    <x-slot name="header">
        <livewire:components.back-link :label='"Lists"' :route="'lists'" />
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lists') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <livewire:form.create-lists></livewire:form.create-lists>
        </div>
       
    </div>
</x-app-layout>
