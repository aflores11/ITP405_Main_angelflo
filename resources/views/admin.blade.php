@extends('layouts.main')

@section('title','Admin Page')

@section('content')
    <div>
        <p>Maintenance Mode:</p>
        @if ($toggle->value == true)
            <form method="post" action="{{ route('maintenanceToggle') }}">
                @csrf
                <input id="toggle" name="toggle" type="submit" value="ON" class="btn btn-success" >
            </form>
        @else
            <form method="post" action="{{ route('maintenanceToggle') }}">
                @csrf
                <input id="toggle" name="toggle" type="submit" value="OFF" class="btn btn-danger" >
            </form>
        @endif
    </div>

    <div>
        <br>
        <form method="post" action="{{ route('emailStats') }}">
            @csrf
            <input id="toggle" name="toggle" type="submit" value="Send Stats to Users" class="btn btn-info" >
        </form>
    </div>
@endsection