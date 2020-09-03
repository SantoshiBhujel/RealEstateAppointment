@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                
                <h3>Appointment Schedule</h3>
                {{-- table for appointed time slot --}}
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">DATE</th>
                        <th scope="col">08:00 AM</th>
                        <th scope="col">09:00 AM</th>
                        <th scope="col">10:00 AM</th>
                        <th scope="col">11:00 AM</th>
                        <th scope="col">12:00 PM</th>
                        <th scope="col">01:00 PM</th>
                        <th scope="col">02:00 PM</th>
                        <th scope="col">03:00 PM</th>
                        <th scope="col">04:00 PM</th>
                        <th scope="col">05:00 PM</th>
                        
                      </tr>
                    </thead>
                    @foreach ($days as $day)
                        <tbody>
                            <tr>
                            <th scope="row">{{ $day->date }}</th>
                            @foreach ($day->timeslots as $slot )

                                @if( $slot->available == 'yes')
                                    <td style="background-color: rgb(84, 226, 84)">YES</td>
                                @else
                                    <td style="color: rgb(233, 82, 71)")>NO</td>
                                @endif
                                
                            @endforeach
                        </tbody>
                    @endforeach
                    
                  </table>
            </div>
            <div class="card">
                <div class="card-header">{{ __('Looking for Appointment? ') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <br>
                    <h4>Search for date you want to appoint</h4>

                    @include('includes.alerts')
                    <form action="{{ route('slot.search') }}" method="POST">

                        @csrf
                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>

                            <div class="col-md-6">
                                <input id="date" type="date" name="date" required value="{{ old('name') }}" autofocus>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Search') }}
                            </button>
                        </div>
                    </form>
                
                    @if (count($slots)>0)
                        <h3>Available slots for {{ $date ?? '' }}</h3>
                        <h4>Select any one of the slot</h4>
                        <form action="{{ route('appointment.store') }}" method="POST">

                            @csrf

                            <input type="hidden" name="date" id="date" value="{{ $date ?? '' }}">
                            
                            @foreach ($slots as $slot )
                                <input type="radio" id="slot" name="slot" value="{{ $slot->slot }}" required>
                                <label for="time">{{ $slot->starts_at }}</label>
                            @endforeach
                            
                            <input type="submit" value="Appoint" >
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
