<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Restaurant dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="alert alert-danger">
                    {{ session('status') }}
                </div>
            @endif
            <form>
                <select name="restaurant" id="category">
                    @foreach($restaurants as $select_restaurant)
                        <option value="{{$select_restaurant->id}}">{{$select_restaurant->name}}</option>
                    @endforeach
                </select>
                <input type="date" class="form-control text-gray-500" name="date"
                       @if(old('date') != null)
                       value="{{ old('date') }}"
                       @else
                       value="{{ date("Y-m-d", strtotime("today")) }}"
                    @endif>
                <button type="submit"
                        class="bg-white hover:bg-gray-100 text-gray-800 py-2 px-4 border border-gray-400 rounded shadow">
                    Filteren
                </button>
            </form>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p class="text-2xl font-medium font-bold">Reserveringen voor {{ $restaurant->name }}
                        op {{date('d-m-Y', strtotime($date))}}</p>
                    @forelse($reservations as $reservation)
                        <p>{{$reservation->time}}</p>
                    @empty
                        <p>Dit restaurant heeft voor vandaag geen reserveringen.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
