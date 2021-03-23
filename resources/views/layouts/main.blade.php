<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>@yield('title')</title>
</head>
<body>
    <div class="container mt-3 mb-3">
        <div class="row">
            <div class="col-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('album.index')}}">Albums</a>
                        <a class="nav-link" href="{{route('album.eloquent.index')}}">Albums (eloquent)</a>
                        <a class="nav-link" href="{{route('playlist.index')}}">Playlists</a>
                        <a class="nav-link" href="{{route('track.index')}}">Tracks</a>
                    </li>
                    @if(Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('profile.index')}}">Profile</a>
                    </li>
                    <li>
                        <form method="post" action="{{ route('auth.logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-link">Logout</button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin')}}">Admin</a>
                    </li>
                    
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('registration.index')}}">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('auth.loginForm')}}">Login</a>
                    </li>
                @endif
                </ul>
            </div>
            <div class="col-9">
                <header>
                    <h2>@yield('title')</h2>
                </header>
                <main>
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
</body>
</html>