<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ $pageTitle }}</title>
    @include('dependency.cdn')
</head>
<body>

    @include('includes.navbar')

    <button class="btn btn-primary">AMD Athlon</button>
    <button class="btn btn-secondary">AMD Athlon</button>
    <button class="btn btn-info">AMD Athlon</button>
    <button class="btn btn-success">AMD Athlon</button>
    <button class="btn btn-warning">AMD Athlon</button>
    <button class="btn btn-danger">AMD Athlon</button>
    <button class="btn btn-light">AMD Athlon</button>
    <button class="btn btn-dark">AMD Athlon</button>

    <p class="text-primary">AMD Athlon</p>


    {{-- <div>
        @if (Route::has('login'))
            <div>
                @auth
                    <a href="{{ url('/home') }}">Home</a>
                @else
                    <a href="{{ route('login') }}">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div> --}}

    <div>
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </div>
    
</body>
</html>

