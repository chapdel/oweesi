<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('List') }} > <small>{{$list->title}}</small>
        </h2>
        <small class="font-semibold text-gray-800 leading-tight">
            {{ __('Audience') }}
            {{-- <a href="{{ route('lists.create')}}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 float-right">{{ __("Add New List")}}</a> --}}
        </small>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <livewire:contacts :list='$list' />
            </div>
        </div>
    </div>
</x-app-layout>