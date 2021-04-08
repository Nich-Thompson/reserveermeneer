<x-app-layout>
    <x-slot name="header">
        <div class="row-auto">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Evenementreservaties') }}
            </h2>
            <div class="text-right">
                <a href="{{ route('exportJson') }}" class="bg-white hover:bg-gray-100 text-gray-800 py-2 px-4 border border-gray-400 rounded shadow">Export naar JSON</a>
                <a href="{{ route('exportCsv') }}" class="bg-white hover:bg-gray-100 text-gray-800 py-2 px-4 border border-gray-400 rounded shadow">Export naar CSV</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @forelse($reservations as $reservation)
                    <div class="p-6 bg-white border-b border-gray-200 flex-row">
                        <div class="d-flex flex-column w-50">
                            <b>Naam: </b>{{ $reservation->name }} <b>E-mailadres: </b>{{ $reservation->email }}<br>
                            <b>Adres: </b> {{ $reservation->address }} <b>Stad: </b> {{ $reservation->city }} <b>Postcode: </b> {{ $reservation->postal_code }}<br>
                            <b>Tickets: </b>{{ $reservation->ticket_number }} <b>Totaalprijs: </b> {{ $reservation->total_price }} euro<br>
                            <b>Van: </b>{{ date("d-m", strtotime($reservation->start_date)) }} <b>Tot: </b>{{ date("d-m", strtotime($reservation->end_date)) }}
                        </div>
                        <div class="d-flex flex-column justify-content-end w-50 text-right pb-2">
                            <br>
                            <img src="{{ url('storage/reservation/'.$reservation->img_path) }}" class="max-h-40">
                        </div>
                    </div>
                @empty
                    <div class="p-6 bg-white border-b border-gray-200 flex-row">
                        Geen reserveringen gevonden.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
