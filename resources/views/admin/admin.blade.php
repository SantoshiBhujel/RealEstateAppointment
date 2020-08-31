@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
