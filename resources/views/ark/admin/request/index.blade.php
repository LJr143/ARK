<x-app-layout>
    <x-slot name="sidebar">
        <x-side-bar></x-side-bar>
    </x-slot>
    <x-slot name="header">
        <x-header></x-header>
    </x-slot>
    <div class="py-4">
        <div class="max-w-full mx-auto sm:px-6 lg:px-6">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <livewire:request.computational-request/>
            </div>
        </div>
    </div>
</x-app-layout>
