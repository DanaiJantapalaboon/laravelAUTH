<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{{ $pageTitle }}</title>
        @include('admin.dependency.cdn')
    </head>

    <style>
        .row a {
            text-decoration: none;
            color: #000;
        }

        .row a:hover {
            color: #000;
        }

        .card {
            transition: transform .3s;
        }

        .card:hover {
          background-color: honeydew;
          transform: scale(1.05);
        }
    </style>


<body id="admin_bg">
    <header>
        @include('admin.includes.navbar')
    </header>


    <div class="container-fluid shadow-sm border-top bg-light">
        <div class="container">
            <h5 class="fw-bold py-3">{{ $pageTitle }}</h5>
        </div>
    </div>


    {{-- ORM Queries --}}
    <?php
        use App\Models\User;
        use App\Models\Carousel;

        $totalUser = User::count();
        $totalCarousel = Carousel::count();
        // $totalUser = User::where('status', 'Accepted')->sum('totalprice');
    ?>

    {{-- Cards --}}
    <div class="container mt-4 mb-4">
        <div class="row">
            <div class="col-xl-4 col-md-6 mb-3">
                <a href="{{ route('web_carousel') }}">
                    <div class="card shadow-sm h-100 py-2">
                        <div class="card-body px-5">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Carousel</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCarousel }}</div>
                                </div>
                                <div class="col-auto"><i class="fa-solid fa-panorama fa-2x"></i></div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-4 col-md-6 mb-3">
                <a href="{{ route('user_management') }}">
                    <div class="card shadow-sm h-100 py-2">
                        <div class="card-body px-5">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Account</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUser }}</div>
                                </div>
                                <div class="col-auto"><i class="fa-solid fa-user-group fa-2x"></i></div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    {{-- @if (Auth::viaRemember())
    <p>Welcome back! You are logged in via "Remember Me".</p>
@else
    <p>Welcome! You are logged in normally.</p>
@endif --}}

    {{-- ============= <script></script> tag below code ============= --}}
    @include('admin.includes.scripttag_below')

    {{-- ============= Footer Copyright ============= --}}
    @include('admin.includes.footer')


</body>
</html>