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
                    <p class="text-2xl font-medium font-bold">Reservering maken bij {{ $restaurant->name }}</p>

                    <form action="{{ route('postRestaurantReserve', $id ) }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-1">
                                <div class="form-group">
                                    <input type="text" class="form-control w-full" name="firstname"
                                           placeholder="Voornaam"
                                           value="{{ old('firstname') }}">
                                </div>
                            </div>

                            <div class="col-span-1">
                                <div class="form-group">
                                    <input type="text" class="form-control w-full" name="lastname"
                                           placeholder="Achternaam"
                                           value="{{ old('lastname') }}">
                                </div>
                            </div>

                            <div class="col-span-1">
                                <div class="form-group">
                                    <input type="text" class="form-control w-full" name="email" placeholder="E-mail"
                                           value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="col-span-1">
                                <div class="form-group">
                                    <input type="text" class="form-control w-full" name="address" placeholder="Adres"
                                           value="{{ old('address') }}">
                                </div>
                            </div>

                            <div class="col-span-1">
                                <div class="form-group">
                                    <input type="text" class="form-control w-full" name="postal_code"
                                           placeholder="Postcode"
                                           value="{{ old('postal_code') }}">
                                </div>
                            </div>


                            <div class="col-span-1">
                                <div class="form-group">
                                    <input type="text" class="form-control w-full" name="city" placeholder="Stad/dorp"
                                           value="{{ old('city') }}">
                                </div>
                            </div>

                            <div class="col-span-1">
                                <div class="form-group">
                                    <input type="date" class="form-control w-full text-gray-500" name="date"
                                           @if(old('date') != null)
                                           value="{{ old('date') }}"
                                           @else
                                           value="{{ date("Y-m-d", strtotime("today")) }}"
                                        @endif>
                                </div>
                            </div>

                            <div class="col-span-1">
                                <div class="form-group">
                                    <input type="time"
                                           class="form-control w-full text-gray-500"
                                           name="time"
                                           @if(old('time') != null)
                                           value="{{ old('time') }}"
                                           @else
                                           value="{{ date("H:i", strtotime("12:00:00")) }}"
                                        @endif>
                                </div>
                            </div>

                            <div class="col-span-1 text-left">
                                <a href="{{ route('getRestaurantIndex') }}"
                                   class="bg-white hover:bg-gray-100 text-gray-800 py-2 px-4 border border-gray-400 rounded shadow">
                                    Terug
                                </a>
                            </div>
                            <div class="col-span-1 text-right">
                                <button type="submit"
                                        class="bg-white hover:bg-gray-100 text-gray-800 py-2 px-4 border border-gray-400 rounded shadow">
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

