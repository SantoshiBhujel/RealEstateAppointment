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

                    <br>
                    <h4>Looking for Appointment? Search for date you want to appoint</h4>

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
                        <form action="" method="POST">

                            @csrf
                            
                            @foreach ($slots as $slot )
                                <input type="radio" id="time" name="time" value="{{ $slot->slot }}">
                                <label for="time">{{ $slot->starts_at }}</label>
                            @endforeach
                            
                            <button type="submit" class="btn btn-primary">
                                {{ __('Appoint') }}
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
