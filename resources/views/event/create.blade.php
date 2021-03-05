<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Evenement aanmaken') }}
        </h2>
    </x-slot>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>De ingevoerde data is niet juist.</strong><br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Tekst
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
