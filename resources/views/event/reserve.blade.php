<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reserveren') }}
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
                    <form action="{{ route('postEventReserve', $id ) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-1">
                                <div class="form-group">
                                    <input type="text" class="form-control w-full" name="name" placeholder="Naam" required>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="form-group">
                                    <input type="text" class="form-control w-full" name="email" placeholder="E-mail" required>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="form-group">
                                    <input type="date" class="form-control w-full text-gray-500" name="start_date" required>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="form-group">
                                    <input type="date" class="form-control w-full text-gray-500" name="end_date" required>
                                </div>
                            </div>
                            <div class="col-span-2">
                                <div class="form-group">
                                    <input type="file" name="file" required>
                                </div>
                            </div>

                            <div class="col-span-1 text-left">
                                <a href="{{ route('getEventIndex') }}" class="bg-white hover:bg-gray-100 text-gray-800 py-2 px-4 border border-gray-400 rounded shadow">
                                    Terug
                                </a>
                            </div>
                            <div class="col-span-1 text-right">
                                <button type="submit" class="bg-white hover:bg-gray-100 text-gray-800 py-2 px-4 border border-gray-400 rounded shadow">
                                    Reserveren
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
