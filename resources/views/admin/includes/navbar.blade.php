<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#"><img src="{{ asset('storage/' . $companyLogo) }}" alt="{{ $companyName }}" style="width: 150px;"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link {{ request()->is('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->is('company_info') ? 'active' : '' }}" href="{{ route('company_info') }}">Company Information</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->is('user_management') ? 'active' : '' }}" href="{{ route('user_management') }}">User Management</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->is('user_profile') ? 'active' : '' }}" href="{{ route('user_profile') }}">My Profile</a></li>
            </ul>

            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item disabled lh-1 mb-2"><small><i class="fa-solid fa-user"></i> {{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}</small></a>
                        <a class="dropdown-item disabled lh-1"><small><i class="fa-solid fa-clock"></i> <span id="date"></span> <span id="clock"></span></small></a>
                        <li><hr class="dropdown-divider"></li>
                        <a class="dropdown-item" href="{{ route('user_profile') }}"><i class="fa-solid fa-user-pen"></i> Profile</a>
                        <form action="{{ route('logout') }}" method="POST" id="logout-form">
                            @csrf
                            @method('DELETE')
                            <a class="dropdown-item" href="#" id="logout-link"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                        </form>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>