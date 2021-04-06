@extends('layouts.email')

@section('content')
    <h1>Here are some Stats!</h1>
    <div class="card" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Total Number of Artists</h5>
          <p class="card-text">{{ $albums }}</p>
        </div>
    </div>
    <div class="card" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Total Number of Playlists</h5>
          <p class="card-text">{{ $playlists }}</p>
        </div>
    </div>
    <div class="card" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Total Number of Playable Minutes</h5>
          <p class="card-text">{{ $tracks }}</p>
        </div>
    </div>
@endsection
