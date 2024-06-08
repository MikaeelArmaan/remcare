<!-- resources/views/appointment/create.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create appointment') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-gray-200 px-6 py-4">
                <h2 class="text-lg font-semibold text-gray-700">Create Appointment</h2>
            </div>

            <div class="px-6 py-4">
                <form method="POST" action="{{ route('appointments.store') }}">
                    @csrf
                    @include('appointments.fields')
                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg">Submit</button>
                        <a href="{{ route('appointments.index') }}" class="ml-2 inline-flex items-center px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 rounded-lg">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
