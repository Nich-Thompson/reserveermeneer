<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Film bewerken') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('postFilmUpdate', $id) }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-1">
                                <label>Titel</label>
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control w-full"
                                           @if(old('name') != null)
                                           value="{{ old('name') }}"
                                           @else
                                           value="{{ $film->name }}"
                                        @endif>
                                </div>
                            </div>
                            <div class="col-span-1 text-right">
                                <br>
                                <a href="{{ route('getFilmDelete', $id) }}" class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 border border-gray-400 rounded shadow">
                                    Verwijderen
                                </a>
                            </div>
                            <div class="col-span-2">
                                <label>Beschrijving</label>
                                <div class="form-group">
                                    <input type="text" name="description" class="form-control w-full" placeholder="Beschrijving"
                                           @if(old('description') != null)
                                           value="{{ old('description') }}"
                                           @else
                                           value="{{ $film->description }}"
                                        @endif>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <label>Halnummer</label>
                                <div class="form-group">
                                    <input type="number" name="hall_id" class="form-control w-full" placeholder="Max. aantal tickets"
                                           @if(old('hall_id') != null)
                                           value="{{ old('hall_id') }}"
                                           @else
                                           value="{{ $film->hall_id }}"
                                        @endif>
                                </div>
                            </div>
                            <div class="col-span-1">
                            {{--empty--}}
                            </div>
                            <div class="col-span-1">
                                <label>Begindatum</label>
                                <div class="form-group">
                                    <input type="datetime-local" name="start_date" class="form-control w-full text-gray-500"
                                           @if(old('start_date') != null)
                                           value="{{ old('start_date') }}"
                                           @else
                                           value="{{ date("Y-m-d\TH:i", strtotime($film->start_date)) }}"
                                        @endif>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <label>Einddatum</label>
                                <div class="form-group">
                                    <input type="datetime-local" name="end_date" class="form-control w-full text-gray-500"
                                           @if(old('end_date') != null)
                                           value="{{ old('end_date') }}"
                                           @else
                                           value="{{ date("Y-m-d\TH:i", strtotime($film->end_date)) }}"
                                        @endif>
                                </div>
                            </div>
{{--                            <div class="col-span-2">--}}
{{--                                <p class="text-gray-400">Door de datum velden leeg te laten worden deze niet veranderd.</p>--}}
{{--                            </div>--}}

                            <div class="col-span-1 text-left">
                                <a href="{{ route('getFilmDetails', $id) }}" class="bg-white hover:bg-gray-100 text-gray-800 py-2 px-4 border border-gray-400 rounded shadow">
                                    Terug
                                </a>
                            </div>
                            <div class="col-span-1 text-right">
                                <button type="submit" class="bg-white hover:bg-gray-100 text-gray-800 py-2 px-4 border border-gray-400 rounded shadow">
                                    Opslaan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
