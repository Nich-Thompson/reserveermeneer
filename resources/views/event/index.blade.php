<x-app-layout>
    <x-slot name="header">
        <div class="row-auto">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Evenementen en Films') }}
            </h2>
            @auth
                <div class="text-right">
                    <a href="{{ route('getEventCreate') }}" class="bg-white hover:bg-gray-100 text-gray-800 py-2 px-4 border border-gray-400 rounded shadow">+Evenement aanmaken</a>
                    <a href="{{ route('getFilmCreate') }}" class="bg-white hover:bg-gray-100 text-gray-800 py-2 px-4 border border-gray-400 rounded shadow">+Film aanmaken</a>
                </div>
            @endauth
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('getEventIndex') }}" method="GET">
                @csrf
                <div class="text-left">
                    <div class="grid grid-cols-5 gap-10">
                        <div class="col-span-1">
                            Filter op: <b>Stad</b><br>
                            <input type="text" name="location" class="form-control" placeholder="Stad">
                        </div>
                        <div class="col-span-1">
                            <b>Starttijd</b><br>
                            <input type="datetime-local" name="start_time" class="form-control">
                        </div>
                        <div class="col-span-1">
                            <b>Eindtijd</b><br>
                            <input type="datetime-local" name="end_time" class="form-control">
                        </div>
                    </div>
                </div>
                <br>
                <div class="text-left">
                    Sorteer op:
                    <input type="submit" name="name_sort" class="bg-white hover:bg-gray-100 text-gray-800 py-1.5 px-3 border border-gray-400 rounded shadow cursor-pointer" value="Naam">
                    <input type="submit" name="location_sort" class="bg-white hover:bg-gray-100 text-gray-800 py-1.5 px-3 border border-gray-400 rounded shadow cursor-pointer" value="Locatie">
                    <input type="submit" name="start_time_sort" class="bg-white hover:bg-gray-100 text-gray-800 py-1.5 px-3 border border-gray-400 rounded shadow cursor-pointer" value="Starttijd">
                </div>
            </form>
            <br>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @foreach($activities as $activity)
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="d-flex flex-column w-50">
                            {{--only events have max_tickets--}}
                            @if($activity['max_tickets'] ?? null)
                                <b>{{ $activity['name'] }}</b> (Evenement)<br>
                                {{ $activity['description'] }}<br>
                                <b>Locatie: </b>{{ $activity['address'] }}, {{ $activity['city'] }}<br>
                                <b>Van: </b>{{ date("d-m H:i", strtotime($activity['start_date'])) }} <b>Tot: </b>{{ date("d-m H:i", strtotime($activity['end_date'])) }}
                        </div>
                                <div class="d-flex flex-column justify-content-end w-50 text-right pb-2">
                                    <a href="{{ route('getEventDetails', $activity['id']) }}" class="bg-white hover:bg-gray-100 text-gray-800 py-2 px-4 border border-gray-400 rounded shadow">+Info</a>
                                </div>
                            @else
                                <b>{{ $activity['name'] }}</b> (Film)<br>
                                {{ $activity['description'] }}<br>
                                <b>Bioscoop: </b>{{ $activity['cinema_name'] }} {{ $activity['city'] }}<br>
                                <b>Van: </b>{{ date("d-m H:i", strtotime($activity['start_date'])) }} <b>Tot: </b>{{ date("d-m H:i", strtotime($activity['end_date'])) }}
                        </div>
                                <div class="d-flex flex-column justify-content-end w-50 text-right pb-2">
                                    <a href="{{ route('getFilmDetails', $activity['id']) }}" class="bg-white hover:bg-gray-100 text-gray-800 py-2 px-4 border border-gray-400 rounded shadow">+Info</a>
                                </div>
                            @endif
                    </div>
                @endforeach
{{--                @foreach($events as $event)--}}
{{--                    <div class="p-6 bg-white border-b border-gray-200">--}}
{{--                        <div class="d-flex flex-column w-50">--}}
{{--                            <b>{{ $event->name }}</b><br>--}}
{{--                            {{ $event->description }}<br>--}}
{{--                            <b>Van: </b>{{ date("d-m H:i", strtotime($event->start_date)) }} <b>Tot: </b>{{ date("d-m H:i", strtotime($event->end_date)) }}--}}
{{--                        </div>--}}
{{--                        <div class="d-flex flex-column justify-content-end w-50 text-right pb-2">--}}
{{--                            <a href="{{ route('getEventDetails', $event->id) }}" class="bg-white hover:bg-gray-100 text-gray-800 py-2 px-4 border border-gray-400 rounded shadow">+Info</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--                @foreach($films as $film)--}}
{{--                    <div class="p-6 bg-white border-b border-gray-200">--}}
{{--                        <div class="d-flex flex-column w-50">--}}
{{--                            <b>{{ $film->name }}</b><br>--}}
{{--                            {{ $film->description }}<br>--}}
{{--                            <b>Van: </b>{{ date("d-m H:i", strtotime($film->start_date)) }} <b>Tot: </b>{{ date("d-m H:i", strtotime($film->end_date)) }}--}}
{{--                        </div>--}}
{{--                        <div class="d-flex flex-column justify-content-end w-50 text-right pb-2">--}}
{{--                            <a href="{{ route('getFilmDetails', $film->id) }}" class="bg-white hover:bg-gray-100 text-gray-800 py-2 px-4 border border-gray-400 rounded shadow">+Info</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
            </div>
        </div>
    </div>
</x-app-layout>
