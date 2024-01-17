<!doctype html>
<html lang="en">
  <head>
    <title>Register</title>
    @include('admin.dependency.cdn')

    <style>
        .divider:after, .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }

        .h-custom {
            height: calc(100% - 0px);
        }
        
        @media (max-width: 480px) {
            .h-custom {
                height: 100%;
            }
        }
    </style>

</head>
<body class="admin-bg">

    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-8 border rounded p-4 bg-light">
                    <div class="text-center">
                        <img src="{{ asset('icons/group.webp') }}" class="w-25" alt="">
                    </div>
                    <div class="d-flex flex-row align-items-center justify-content-center">
                        <p class="lead fw-normal mb-0">Register</p>
                    </div>
                    <div class="divider d-flex align-items-center my-4"></div>

                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        @if(Session::has('success'))
                            <div class="alert alert-success text-center text-success" role="alert">{{ Session::get('success') }}<a href="{{ route('login') }}" class="link-primary fw-bold">Login</a></div>
                        @endif

                        @if(Session::has('error'))
                            <div class="alert alert-danger text-center text-danger" role="alert">{{ Session::get('error') }}</div>
                        @endif

                        <div class="row">
                            <!-- Firstname input -->
                            <div class="col-md-4 mb-2">
                                <label for="firstname">First name <span class="text-danger">*</span></label>
                                <input type="text" name="firstname" id="firstname" class="form-control" placeholder="..." required>
                            </div>

                            <!-- Lastname input -->
                            <div class="col-md-4 mb-2">
                                <label for="lastname">Last name <span class="text-danger">*</span></label>
                                <input type="text" name="lastname" id="lastname" class="form-control" placeholder="..." required>
                            </div>

                            <!-- Position input -->
                            <div class="col-md-4 mb-2">
                                <label for="position">Position <span class="text-danger">*</span></label>
                                <input type="text" name="position" id="position" class="form-control" placeholder="..." required>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Email input -->
                            <div class="col-md-4 mb-2">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="..." required>
                            </div>

                            <!-- Password input -->
                            <div class="col-md-4 mb-2">
                                <label for="password">Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" id="password" class="form-control" min="4" placeholder="..." required>
                            </div>

                            <!-- Password input -->
                            <div class="col-md-4 mb-2">
                                <label for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" min="4" placeholder="..." required>
                            </div>
                        </div>

                        <!-- Login & Register Button -->
                        <div class="text-center text-lg-start pt-2">
                            <button type="submit" class="btn btn-primary btn-lg shadow-sm w-100">Register</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Already an account? <a href="{{ route('login') }}" class="link-primary">Login</a></p>
                        </div>
                    </form>
                </div>
                {{-- ============= Footer Copyright ============= --}}
                @include('admin.includes.footer')
            </div>
        </div>
    </section>

</body>