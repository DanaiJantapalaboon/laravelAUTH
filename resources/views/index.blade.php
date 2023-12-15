<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ $pageTitle }}</title>
    @include('dependency.cdn')

    <style>
        .carousel-item {
            height: 512px;
        }
        .carousel-indicators [data-bs-target] {
            width: 20px;
            height: 20px;
            border-radius: 50%;
        }
    </style>
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

    <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-indicators">
            @foreach($carousel as $index => $content)
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-current="true" aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
        </div>
        <div class="carousel-inner">
            @foreach($carousel as $index => $content)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <img src="{{ asset('storage/' . $content->image) }}" class="d-block w-100" alt="{{ $content->title }}">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>{{ $content->title }}</h5>
                        <p>{{ $content->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


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

