<x-app-layout>
    <x-slot name="header">
        <div class="row-auto">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Restaurants') }}
            </h2>
            {{--            @auth--}}
            {{--                <div class="text-right">--}}
            {{--                    <a href="{{ route('getEventCreate') }}"--}}
            {{--                       class="bg-white hover:bg-gray-100 text-gray-800 py-2 px-4 border border-gray-400 rounded shadow">+Evenement--}}
            {{--                        aanmaken</a>--}}
            {{--                </div>--}}
            {{--            @endauth--}}
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form>
                <select name="category" id="category">
                    @foreach($categories as $category)
                        <option value="{{$category->type}}">{{$category->type}}</option>
                    @endforeach
                </select>
                <button type="submit"
                        class="bg-white hover:bg-gray-100 text-gray-800 py-2 px-4 border border-gray-400 rounded shadow">
                    Filteren
                </button>
            </form>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @forelse ($restaurants as $restaurant)
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="d-flex flex-column w-50">
                            <p class="text-2xl font-medium font-bold">{{ $restaurant->name }}</p>
                            <p class="mt-1 mb-5 text-gray-700">{{ $restaurant->type }}</p>
                            <div class="grid grid-cols-3 gap-4">
                                <div>
                                    <strong>
                                        Maandag:
                                    </strong>
                                    {{render_opening_time($restaurant->monday_opening_time, $restaurant->monday_closing_time)}}
                                </div>
                                <div>
                                    <strong>
                                        Dinsdag:
                                    </strong>
                                    {{render_opening_time($restaurant->tuesday_opening_time, $restaurant->tuesday_closing_time)}}
                                </div>
                                <div>
                                    <strong>
                                        Woensdag:
                                    </strong>
                                    {{render_opening_time($restaurant->wednesday_opening_time, $restaurant->wednesday_closing_time)}}
                                </div>
                                <div>
                                    <strong>
                                        Donderdag:
                                    </strong>
                                    {{render_opening_time($restaurant->thursday_opening_time, $restaurant->thursday_closing_time)}}
                                </div>
                                <div>
                                    <strong>
                                        Vrijdag:
                                    </strong>
                                    {{render_opening_time($restaurant->friday_opening_time, $restaurant->friday_closing_time)}}
                                </div>
                                <div>
                                    <strong>
                                        Zaterdag:
                                    </strong>
                                    {{render_opening_time($restaurant->saturday_opening_time, $restaurant->saturday_closing_time)}}
                                </div>
                                <div>
                                    <strong>
                                        Zondag:
                                    </strong>{{render_opening_time($restaurant->sunday_opening_time, $restaurant->sunday_closing_time)}}
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-end w-50 text-right pb-2">
                                <a href="{{ route('getRestaurantReserve', $restaurant->id) }}"
                                   class="bg-white hover:bg-gray-100 text-gray-800 py-2 px-4 border border-gray-400 rounded shadow">Reserveren</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-6 bg-white border-b border-gray-200">
                        <p>Geen restaurants gevonden in deze categorie.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
