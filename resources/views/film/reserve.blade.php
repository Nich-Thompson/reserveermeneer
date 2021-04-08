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
                    <form action="{{ route('postFilmReserve', $id ) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-1">
                                <div class="form-group">
                                    <input type="text" class="form-control w-full" name="name" placeholder="Naam" value="{{ old('name') }}">
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="form-group">
                                    <input type="text" class="form-control w-full" name="email" placeholder="E-mail" value="{{ old('email') }}">
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="form-group">
                                    <input type="text" class="form-control w-full" name="address" placeholder="Adres" value="{{ old('address') }}">
                                </div>
                            </div>
                            <div class="col-span-1">
                                {{--empty--}}
                            </div>
                            <div class="col-span-1">
                                <div class="form-group">
                                    <input type="text" class="form-control w-full" name="postal_code" placeholder="Postcode" value="{{ old('postal_code') }}">
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="form-group">
                                    <input type="text" class="form-control w-full" name="city" placeholder="Stad" value="{{ old('city') }}">
                                </div>
                            </div>

                            <div class="col-span-2 m-auto">
                                <b>Kies een stoel: </b>
                            </div>
                            <div class="col-span-2">
                                <div class="grid grid-cols-{{ $maxX + 1 }} gap-4 max-w-screen-md align-middle m-auto">
                                    @for($i = 0; $i < $maxY + 1; $i++)
                                        @for($j = 0; $j < $maxX + 1; $j++)
                                            <span hidden>{{
                                                    $seat = $seats->where('x', $j)->where('y', $i)->first()
                                                }}</span>
                                            @if($seat->occupied == false)
                                                <div class="col-span-1 outline-black hover:bg-gray-300 bg-green-100 cursor-pointer" id="{{ $seat->id }}" onclick="select( {{ $seat->id }} )">
                                                    Beschikbaar
                                                </div>
                                            @else
                                                <div class="col-span-1 outline-black bg-red-300" id="{{ $seat->id }}">
                                                    Bezet
                                                </div>
                                            @endif
                                        @endfor
                                    @endfor
                                </div>
                            </div>

                            {{--hidden seat input--}}
                            <input type="number" id="seatId" name="seat_id" value="-1" hidden>

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

<script>
    function select(id) {
        let select = document.getElementById('seatId')
        select.setAttribute('value', id)

        let seatElements = document.getElementsByClassName('col-span-1 outline-black hover:bg-gray-300 bg-green-100 cursor-pointer selected')
        for (let i = 0; i < seatElements.length; i++) {
            if (seatElements[i].classList.contains('selected')) {
                seatElements[i].setAttribute('style', '')
                seatElements[i].classList.remove('selected')
            }
        }

        let selectedElement = document.getElementById(id)
        selectedElement.classList.add('selected')
        selectedElement.setAttribute('style', 'background: bisque')
    }
</script>
