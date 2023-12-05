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


    {{-- ============= 1. Add User หน้า User Management ============= --}}
    <div class="container shadow-sm rounded bg-light p-4 mt-4">
        <p><span class="fw-bold">Add User's Account</span><br><span class="text-secondary">Add user account's information and email address.</span></p>
        {{-- @if(session('error'))
            <div class="alert alert-danger text-danger text-center" role="alert">{{ session('error') }}</div>
        @endif --}}
        <form action="{{ route('add-users') }}" method="POST">
            @csrf
            <div class="row">
                <!-- Firstname input -->
                <div class="col-md-4 mb-2">
                    <label for="firstname">First name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="firstname" id="firstname" placeholder="..." required>
                </div>

                <!-- Lastname input -->
                <div class="col-md-4 mb-2">
                    <label for="lastname">Last name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="..." required>
                </div>

                <!-- Position input -->
                <div class="col-md-4 mb-2">
                    <label for="position">Position <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="position" id="position" placeholder="..." required>
                </div>
            </div>
            <div class="row">
                <!-- Email input -->
                <div class="col-md-4 mb-3">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('emailError') is-invalid @enderror" name="email" id="email" placeholder="..." required>
                    @error('emailError')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password input -->
                <div class="col-md-4 mb-3">
                    <label for="newPassword">New Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" name="newPassword" id="newPassword">
                </div>

                <!-- Password input -->
                <div class="col-md-4 mb-3">
                    <label for="confirmPassword">Confirm Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control @error('newPassword') is-invalid @enderror" name="newPassword_confirmation" id="confirmPassword">
                    @error('newPassword')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-dark px-3 shadow-sm">SAVE</button>
            </div>
        </form>
    </div>


    
    {{-- ============= 2. User account table หน้า Profile ============= --}}
    <div class="container shadow-sm rounded bg-light p-4 mt-4 mb-4">
        <p><span class="fw-bold">User management table</span><br><span class="text-secondary">You can manages all user account's in this table.</span></p>
        @if(session('error_delete'))
            <div class="alert alert-danger text-danger text-center" role="alert">{{ session('error_delete') }} <a href="{{ route('user_profile') }}" class="link-primary fw-bold">Go to My Profile</a></div>
        @endif
        @if(session('error_duplicateEmail'))
            <div class="alert alert-danger text-danger text-center" role="alert">{{ session('error_duplicateEmail') }}</div>
        @endif

        <table class="table table-striped table-hover css-serial" id="myTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Position</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $all_user)
                    <tr>
                        <td></td>
                        <td>{{ $all_user->firstname }}</td>
                        <td>{{ $all_user->lastname }}</td>
                        <td>{{ $all_user->position }}</td>
                        <td>{{ $all_user->email }}</td>
                        <td>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $all_user->id }}"><i class="fas fa-edit"></i></button>
                                    <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $all_user->id }}"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        </td>
                    </tr>


                    <!-- Modal Edit Users -->
                    <div class="modal fade" id="editModal{{ $all_user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-light" id="exampleModalLabel">Edit User's Account ?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('edit-users', $all_user->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="modal-body">
                                        <div class="mb-0">
                                            <label for="editFirstname">Firstname <span class="text-danger"> *</span></label>
                                            <input type="text" class="form-control" name="editFirstname" id="editFirstname" value="{{ $all_user->firstname }}" placeholder="..." required>
                                        </div>
                                        <div class="mb-0 mt-2">
                                            <label for="editLastname">Lastname <span class="text-danger"> *</span></label>
                                            <input type="text" class="form-control" name="editLastname" id="editLastname" value="{{ $all_user->lastname }}" placeholder="..." required>
                                        </div>
                                        <div class="mb-0 mt-2">
                                            <label for="editPosition">Position <span class="text-danger"> *</span></label>
                                            <input type="text" class="form-control" name="editPosition" id="editPosition" value="{{ $all_user->position }}" placeholder="..." required>
                                        </div>
                                        <div class="mb-0 mt-2">
                                            <label for="editEmail">Email</label>
                                            <input type="email" class="form-control" id="editEmail" aria-describedby="emailHelp" value="{{ $all_user->email }}" disabled>
                                            <small id="emailHelp" class="form-text text-muted">To change an email, Please logged into this account to proceed.</small>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i> Edit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <!-- Modal Delete Users -->
                    <div class="modal fade" id="deleteModal{{ $all_user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-danger">
                                    <h5 class="modal-title text-light" id="exampleModalLabel">Delete User's Account ?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Please confirm to delete this account ? <br><br>
                                    Name : {{ $all_user->firstname. ' ' .$all_user->lastname}} <br>
                                    Email : {{ $all_user->email }} <br>
                                    Position : {{ $all_user->position }}
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('delete-users', $all_user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>

    </div>






    {{-- ============= <script></script> tag below code ============= --}}
    @include('admin.includes.scripttag_below')

    {{-- ============= Footer Copyright ============= --}}
    @include('admin.includes.footer')


</body>
</html>