<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reserve') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>The submitted data is incorrect.</strong><br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('postEventReserveEnglish', $id ) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-1">
                                <div class="form-group">
                                    <input type="text" class="form-control w-full" name="name" placeholder="Name" value="{{ old('name') }}">
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="form-group">
                                    <input type="text" class="form-control w-full" name="email" placeholder="E-mail" value="{{ old('email') }}">
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="form-group">
                                    <input type="text" class="form-control w-full" name="address" placeholder="Address" value="{{ old('address') }}">
                                </div>
                            </div>
                            <div class="col-span-1">
                                {{--empty--}}
                            </div>
                            <div class="col-span-1">
                                <div class="form-group">
                                    <input type="text" class="form-control w-full" name="postal_code" placeholder="Postal code" value="{{ old('postal_code') }}">
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="form-group">
                                    <input type="text" class="form-control w-full" name="city" placeholder="City" value="{{ old('city') }}">
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="form-group">
                                    <input type="date" class="form-control w-full text-gray-500" name="start_date"
                                           @if(old('start_date') != null)
                                           value="{{ old('start_date') }}"
                                           @else
                                           value="{{ date("Y-m-d", strtotime($event->start_date)) }}"
                                        @endif>
                                </div>
                                <label>This event runs from {{ date("Y-m-d", strtotime($event->start_date)) }} to {{ date("Y-m-d", strtotime($event->end_date)) }}</label>
                            </div>
                            <div class="col-span-1">
                                <div class="form-group">
                                    <input type="number" name="ticket_number" class="form-control w-full" placeholder="Ticket amount" value="{{ old('ticket_number') }}">
                                </div>
                                <label>The maximum number of tickets is {{ $event->max_tickets }}.</label>
                            </div>
                            <div class="col-span-1">
                                <div class="form-group">
                                    {{--<div class="flex-row">--}}
                                    <input type="radio" class="form-control" name="days_count" value="1" {{ (old('days_count') == '1') ? 'checked' : ''}} checked>
                                    <label>1 Day</label>
                                    <input type="radio" class="form-control" name="days_count" value="2" {{ (old('days_count') == '2') ? 'checked' : ''}}>
                                    <label>2 Days</label>
                                    <input type="radio" class="form-control" name="days_count" value="3" {{ (old('days_count') == '3') ? 'checked' : ''}}>
                                    <label>All Days</label>
                                    {{--</div>--}}
                                </div>
                            </div>
                            <div class="col-span-2">
                                <div class="form-group">
                                    <label for="file" class="bg-gray-200 hover:bg-gray-300 text-gray-800 py-1 px-2 border border-black rounded shadow">Upload photo:</label>
                                    <input type="file" id="file" name="file" hidden>
                                </div>
                            </div>

                            <div class="col-span-1 text-left">
                                <a href="{{ route('getEventIndex') }}" class="bg-white hover:bg-gray-100 text-gray-800 py-2 px-4 border border-gray-400 rounded shadow">
                                    Back
                                </a>
                            </div>
                            <div class="col-span-1 text-right">
                                <button type="submit" class="bg-white hover:bg-gray-100 text-gray-800 py-2 px-4 border border-gray-400 rounded shadow">
                                    Reserve
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
