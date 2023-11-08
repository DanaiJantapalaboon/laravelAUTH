<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ $pageTitle }}</title>
    @include('dependency.cdn')
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid" style="border-bottom: 2px solid red">
            <a class="navbar-brand" href="#"><a class="navbar-brand" href="#"><img src="{{ asset('storage/' . $companyLogo) }}" alt="{{ $companyName }}" style="width: 150px;"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Fedatures</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <button class="btn btn-primary">AMD Athlon</button>
    <button class="btn btn-secondary">AMD Athlon</button>
    <button class="btn btn-info">AMD Athlon</button>
    <button class="btn btn-success">AMD Athlon</button>
    <button class="btn btn-warning">AMD Athlon</button>
    <button class="btn btn-danger">AMD Athlon</button>
    <button class="btn btn-light">AMD Athlon</button>
    <button class="btn btn-dark">AMD Athlon</button>

    <p class="text-primary">AMD Athlon</p>


    <div>
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


        <div>
            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </div>
    </div>
    
</body>
</html>

