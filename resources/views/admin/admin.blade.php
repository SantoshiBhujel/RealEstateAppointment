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

                                @if( $slot->available == 'appointed')
                                    <td>Appointed</td>
                                @else
                                    <td></td>
                                @endif
                                
                            @endforeach
                        </tbody>
                    @endforeach
                    
                  </table>
            </div>

            <h3>Appointment Details</h3>
            <div>
                {{-- table for appointed time slot --}}
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">DATE</th>
                        {{-- <th scope="col">Date</th> --}}
                        <th scope="col">Time</th>
                        <th scope="col">By</th>
                      </tr>
                    </thead>
                    @foreach ($appointments as $appointment)
                        <tbody>
                            <tr>
                            <th scope="row">{{ $appointment->date }}</th>
                            <td>{{ $appointment->start_time }}</td>
                            <td> {{ $appointment->user->name }} </td>
                            </tr>
                        </tbody>
                    @endforeach
                    
                  </table>
            </div>
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Welcome Admin') }}

                    @include('includes.alerts')
                    <form method="POST" action="{{ route('workinghour.store') }}">
                        @csrf
    
                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>

                            <div class="col-md-6">
                                <input id="date" type="date" name="date" value="{{ today() }}" required autofocus>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="start_at" class="col-md-4 col-form-label text-md-right">{{ __('Starts At') }}</label>

                            <div class="col-md-6">
                                <input id="start_at" type="time" name="start_at" min="08:00" max="18:00" autofocus>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="finish_at" class="col-md-4 col-form-label text-md-right">{{ __('Ends At') }}</label>

                            <div class="col-md-6">
                                <input id="finish_at" type="time" name="finish_at" min="08:00" max="18:00" autofocus>
                            </div>
                        </div>
                        <button type="submit">Submit</button>
                    </form>
                    

                    @foreach ($working_days as $day)
                        <h4>{{ $day->date }}</h4> from <h5>{{ $day->start_time }}</h5> to <h5>{{ $day->finish_time }}</h5>
                        <br>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
