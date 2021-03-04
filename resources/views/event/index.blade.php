<x-app-layout>
    <x-slot name="header">
        <div class="row-auto">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Evenementen') }}
            </h2>
            @auth
                <div class="text-right">
                    <a href="{{ route('getEventCreate')/*URL::to('/evenementen/create')*/ }}">+Evenement Toevoegen</a>
                </div>
            @endauth
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @foreach($events as $event)
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="d-flex flex-column w-50">
                            {{ $event->title }}<br>
                            {{ $event->description }}
                        </div>
                        <div class="d-flex flex-column justify-content-end w-50 text-right pb-2">
                            <a href="{{ route('getEventDetails', $event->id) }}">+Info</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
