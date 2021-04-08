<x-app-layout>
    <x-slot name="header">
        <div class="row-auto">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Evenementen en Films') }}
            </h2>
            @auth
                <div class="text-right">
                    <a href="{{ route('getEventCreate') }}"
                       class="bg-white hover:bg-gray-100 text-gray-800 py-2 px-4 border border-gray-400 rounded shadow">+Evenement
                        aanmaken</a>
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
                            <b>{{ $event->title }}</b><br>
                            {{ $event->description }}<br>
                            <b>Van: </b>{{ date("d-m h:i", strtotime($event->start_date)) }}
                            <b>Tot: </b>{{ date("d-m h:i", strtotime($event->end_date)) }}
                        </div>
                        <div class="d-flex flex-column justify-content-end w-50 text-right pb-2">
                            <a href="{{ route('getEventDetails', $event->id) }}"
                               class="bg-white hover:bg-gray-100 text-gray-800 py-2 px-4 border border-gray-400 rounded shadow">+Info</a>
                        </div>
                    </div>
                @endforeach
                @foreach($films as $film)
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="d-flex flex-column w-50">
                            <b>{{ $film->name }}</b><br>
                            {{ $film->description }}<br>
                            <b>Van: </b>{{ date("d-m h:i", strtotime($film->start_time)) }}
                            <b>Tot: </b>{{ date("d-m h:i", strtotime($film->end_time)) }}
                        </div>
                        <div class="d-flex flex-column justify-content-end w-50 text-right pb-2">
                            <a href="{{ route('getFilmDetails', $film->id) }}"
                               class="bg-white hover:bg-gray-100 text-gray-800 py-2 px-4 border border-gray-400 rounded shadow">+Info</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
