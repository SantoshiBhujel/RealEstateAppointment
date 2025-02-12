@if(count($errors)>0)
<ul>
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
</ul>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger">
    {!! session('error')!!}
    </div>
@endif

@if(session('Success'))
    <div class=" alert alert-success">
        {!! session('Success')!!}
    </div>
@endif  

