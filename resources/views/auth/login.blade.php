<!doctype html>
<html lang="en">
  <head>
    <title>Login</title>
    @include('admin.dependency.cdn')

    <style>
        .divider:after, .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }
        .h-custom {
            height: calc(100% - 10px);
        }
        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
        }
    </style>

</head>
<body>

    <section class="vh-100" id="admin_bg">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-12 col-lg-6 col-xl-4 border rounded p-4 bg-light">
                    <div class="text-center">
                        <img src="{{ asset('icons/loginkey.png') }}" class="w-50" alt="">
                    </div>
                    <div class="d-flex flex-row align-items-center justify-content-center">
                        <p class="lead fw-normal mb-0">Sign in</p>
                    </div>
                    <div class="divider d-flex align-items-center my-4"></div>

                    @if(Session::has('success'))
                        <div class="alert alert-success text-center text-success" role="alert">{{ Session::get('success') }}</div>
                    @endif

                    @if(session('accountDeleted'))
                        <div class="alert alert-danger text-center text-danger" role="alert">{{ session('accountDeleted') }}</div>
                    @endif

                    <!-- Login Form -->
                    <form action="{{ route('login') }}" method="POST">
                        @csrf

                        <!-- Email input -->
                        <div class="mb-2">
                            <input type="email" name="email" class="form-control form-control @error('loginError') is-invalid @enderror" placeholder="Email address" required>
                        </div>

                        <!-- Password input -->
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control @error('loginError') is-invalid @enderror" placeholder="Password" required>
                            @error('loginError')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Remember me & Forgot Password -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="form-check mb-0">
                                <input class="form-check-input me-2" type="checkbox" name="remember" id="form2Example3">
                                <label class="form-check-label" for="form2Example3">Remember me</label>
                            </div>
                            <a href="#" class="text-body" data-bs-toggle="modal" data-bs-target="#exampleModal">Forgot password?</a>
                        </div>

                        <!-- Login & Register Button -->
                        <div class="text-center text-lg-start mt-2 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg shadow-sm w-100">Login</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="{{ route('register') }}" class="link-danger">Register</a></p>
                        </div>
                    </form>
                </div>
                {{-- ============= Footer Copyright ============= --}}
                @include('admin.includes.footer')
            </div>
        </div>
    </section>



    <!-- Forgot Password Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-dark"><i class="fa-solid fa-clock-rotate-left"></i> Reset Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center"><img class="mb-3" src="{{ asset('icons/unlock.png') }}" alt="" width="180"></div>
                        <form action="{{ route('reset-password') }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="mb-0">
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="mb-0 mt-2">
                                <input type="password" name="password" class="form-control" placeholder="New password" required>
                            </div>
                            <div class="mb-0 mt-2">
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm new password" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary shadow-sm" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary shadow-sm" name="reset"><i class="fa-solid fa-floppy-disk"></i> Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>