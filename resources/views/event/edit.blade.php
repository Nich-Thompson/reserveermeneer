<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Evenement bewerken') }}
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
                    <form action="{{ route('postEventUpdate', $id) }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-1">
                                <label>Titel</label>
                                <div class="form-group">
                                    <input type="text" name="title" class="form-control w-full"
                                           @if(old('title') != null)
                                           value="{{ old('title') }}"
                                           @else
                                           value="{{ $event->title }}"
                                        @endif>
                                </div>
                            </div>
                            <div class="col-span-1 text-right">
                                <br>
                                <a href="{{ route('getEventDelete', $id) }}" class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 border border-gray-400 rounded shadow">
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
                                            value="{{ $event->description }}"
                                        @endif>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <label>Max. aantal tickets</label>
                                <div class="form-group">
                                    <input type="number" name="max_tickets" class="form-control w-full" placeholder="Max. aantal tickets"
                                           @if(old('max_tickets') != null)
                                           value="{{ old('max_tickets') }}"
                                           @else
                                           value="{{ $event->max_tickets }}"
                                        @endif>
                                </div>
                            </div>
                            <div class="col-span-1  ">
                                <label>Prijs</label>
                                <div class="form-group">
                                    <input type="number" step=".01" name="price" class="form-control w-full" placeholder="Prijs"
                                           @if(old('price') != null)
                                           value="{{ old('price') }}"
                                           @else
                                           value="{{ $event->price }}"
                                        @endif>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <label>Begindatum</label>
                                <div class="form-group">
                                    <input type="datetime-local" name="start_date" class="form-control w-full text-gray-500"
                                           @if(old('start_date') != null)
                                           value="{{ old('start_date') }}"
                                           @else
                                           value="{{ date("Y-m-d\TH:i", strtotime($event->start_date)) }}"
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
                                           value="{{ date("Y-m-d\TH:i", strtotime($event->end_date)) }}"
                                        @endif>
                                </div>
                            </div>
                            <div class="col-span-2">
                                <p class="text-gray-400">Door de datum velden leeg te laten worden deze niet veranderd.</p>
                            </div>

                            <div class="col-span-1 text-left">
                                <a href="{{ route('getEventDetails', $id) }}" class="bg-white hover:bg-gray-100 text-gray-800 py-2 px-4 border border-gray-400 rounded shadow">
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
