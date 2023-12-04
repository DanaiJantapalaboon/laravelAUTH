<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{{ $pageTitle }}</title>
        @include('admin.dependency.cdn')
    </head>
<body id="admin_bg">

    <header>
        @include('admin.includes.navbar')
    </header>


    <div class="container-fluid shadow-sm border-top bg-light">
        <div class="container">
            <h5 class="fw-bold py-3">{{ $pageTitle }}</h5>
        </div>
    </div>


    {{-- ============= 1. update Personal Info หน้า Profile ============= --}}
    <div class="container shadow-sm rounded bg-light p-4 mt-4">
        <p><span class="fw-bold">1. Profile Information</span><br><span class="text-secondary">Update your account's profile information.</span></p>
        <form action="{{ route('update-profile', Auth::user()->id) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="editFirstname" class="form-label">First name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="editFirstname" id="editFirstname" value="{{ Auth::user()->firstname }}" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="editLastname" class="form-label">Last name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="editLastname" id="editLastname" value="{{ Auth::user()->lastname }}" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="editPosition" class="form-label">Position <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="editPosition" id="editPosition" value="{{ Auth::user()->position }}" required>
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-dark px-3 shadow-sm">SAVE</button>
            </div>
        </form>
    </div>



    {{-- ============= 2. update Email หน้า Profile ============= --}}
    <div class="container shadow-sm rounded bg-light p-4 mt-4">
        <p><span class="fw-bold">2. Change Email</span><br><span class="text-secondary">Update or change of your email address.</span></p>
        <form action="{{ route('update-email', Auth::user()->id) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="editEmail" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('emailError') is-invalid @enderror" name="editEmail" id="editEmail" value="{{ Auth::user()->email }}" required>
                    @error('emailError')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-dark px-3 shadow-sm">SAVE</button>
            </div>
        </form>
    </div>


    
    {{-- ============= 3. update password หน้า Profile ============= --}}
    <div class="container shadow-sm rounded bg-light p-4 mt-4">
        <p><span class="fw-bold">3. Update Password</span><br><span class="text-secondary">Ensure your account is using a long, random password to stay secure.</span></p>
        @if(session('success'))
            <div class="alert alert-success text-success text-center">{{ session('success') }}</div>
        @endif
        <form action="{{ route('update-password', Auth::user()->id) }}" method="POST">
            @csrf
            <div class="col-md-6 mb-3">
                <label for="currentPassword" class="form-label">Current Password <span class="text-danger">*</span></label>
                <input type="password" class="form-control @error('currentPassword') is-invalid @enderror" name="currentPassword" id="currentPassword">
                @error('currentPassword')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="newPassword" class="form-label">New Password <span class="text-danger">*</span></label>
                <input type="password" class="form-control @error('newPassword') is-invalid @enderror" name="newPassword" id="newPassword">
                @error('newPassword')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                <input type="password" class="form-control" name="newPassword_confirmation" id="confirmPassword">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-dark px-3 shadow-sm">SAVE</button>
            </div>
        </form>
    </div>



    {{-- ============= 4. delete account หน้า Profile ============= --}}
    <div class="container shadow-sm rounded bg-light p-4 mt-4 mb-4">
        <div class="col-md-6">
            @if(session('passwordIncorrect'))
                <div class="alert alert-danger text-center text-danger">{{ session('passwordIncorrect') }}</div>
            @endif
            <p><span class="fw-bold">4. Delete Account</span><br><span class="text-secondary">Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.</span></p>
        </div>
        <button type="submit" class="btn btn-danger px-4" data-bs-toggle="modal" data-bs-target="#exampleModal">DELETE ACCOUNT</button>
    </div>
    <div class="modal modal-lg fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('delete-account', Auth::user()->id) }}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <p><span class="fw-bold">Are you sure you want to delete your account ?</span><br><span class="text-secondary">Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.</span></p>
                        <div class="col-md-8">
                            <input type="password" class="form-control mt-3 mb-1" name="deletePassword" placeholder="Your password" required>
                        </div>
                    </div>
                    <div class="modal-footer px-4">
                        <button type="button" class="btn btn-outline-secondary px-4 shadow-sm" data-bs-dismiss="modal">CANCEL</button>
                        <button type="submit" class="btn btn-danger px-4 shadow-sm">DELETE ACCOUNT</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- ============= <script></script> tag below code ============= --}}
    @include('admin.includes.scripttag_below')

    {{-- ============= Footer Copyright ============= --}}
    @include('admin.includes.footer')


</body>
</html>