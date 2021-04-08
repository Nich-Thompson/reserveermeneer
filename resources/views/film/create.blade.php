<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Evenement aanmaken') }}
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
                    <form action="{{ route('postFilmCreate') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-1">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control w-full" placeholder="Naam" value="{{ old('name') }}">
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="form-group">
                                    <input type="number" name="hall_id" class="form-control w-full" placeholder="Halnummer" value="{{ old('hall_id') }}">
                                </div>
                            </div>
                            <div class="col-span-2">
                                <div class="form-group">
                                    <input type="text" name="description" class="form-control w-full" placeholder="Beschrijving" value="{{ old('description') }}">
                                </div>
                            </div>
                            <div class="col-span-1">
                                <label>Starttijd</label>
                                <div class="form-group">
                                    <input type="datetime-local" name="start_time" class="form-control w-full text-gray-500" value="{{ old('start_time') }}">
                                </div>
                            </div>
                            <div class="col-span-1">
                                <label>Eindtijd</label>
                                <div class="form-group">
                                    <input type="datetime-local" name="end_time" class="form-control w-full text-gray-500" value="{{ old('end_time') }}">
                                </div>
                            </div>

                            <div class="col-span-1 text-left">
                                <a href="{{ route('getEventIndex') }}" class="bg-white hover:bg-gray-100 text-gray-800 py-2 px-4 border border-gray-400 rounded shadow">
                                    Terug
                                </a>
                            </div>
                            <div class="col-span-1 text-right">
                                <button type="submit" class="bg-white hover:bg-gray-100 text-gray-800 py-2 px-4 border border-gray-400 rounded shadow">
                                    Aanmaken
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
