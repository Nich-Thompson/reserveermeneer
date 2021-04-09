<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Delete {{ $event->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <h1>Weet je zeker dat je dit event wilt verwijderen?</h1>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="col-span-1 col-xs-12 col-sm-12 col-md-2 text-left">
                            <a href="{{ route('getEventUpdate', $id) }}" class="bg-white hover:bg-gray-100 text-gray-800 py-2 px-4 border border-gray-400 rounded shadow">Terug</a>
                        </div>
                        <div class="col-span-1 col-xs-12 col-sm-12 col-md-10 text-right">
                            <form action="{{ route('postEventDelete', $id) }}" method="post">
                                @csrf
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 border border-gray-400 rounded shadow">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
