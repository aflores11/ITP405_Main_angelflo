@extends('layouts.main')

@section('title','Admin Page')

@section('content')
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
@endsection