<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{{ $pageTitle }}</title>
        @include('admin.dependency.cdn')
    </head>

    <style>
        .menu-row a {
            text-decoration: none;
            color: #000;

            & .menu-button:hover {
                background-color: honeydew;
            }
        }
    </style>

<body class="admin-bg">
    
    @include('admin.includes.navbar')


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
        <div class="menu-row row">
            <div class="col-xl-4 col-md-6 mb-3">
                <a href="{{ route('web_carousel') }}">
                    <div class="menu-button card shadow-sm h-100 py-2">
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
                    <div class="menu-button card shadow-sm h-100 py-2">
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

    @include('admin.includes.pagescript')
    @include('admin.includes.footer')

</body>
</html>