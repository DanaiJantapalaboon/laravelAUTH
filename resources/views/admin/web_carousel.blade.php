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


    {{-- ============= 1. Add Carousel หน้า Carousel ============= --}}
    <div class="container shadow-sm rounded bg-light p-4 mt-4 mb-4">
        <p><span class="fw-bold">Add Your Webpage Carousel</span><br><span class="text-secondary">To add the webpage carousel, the carousel will be used to display on your main page.</span></p>
        <form action="{{ route('add-carousels') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <input type="hidden" name="addedby" value="{{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}" readonly>
                <!-- Input Title -->
                <div class="col-md-4 mb-2">
                    <label for="title">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="title" id="title" maxlength="100" placeholder="..." required>
                </div>

                <!-- Input Description -->
                <div class="col-md-8 mb-2">
                    <label for="description">Description <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="description" id="description" maxlength="255" placeholder="..." required>
                </div>
            </div>


            <div class="row">
                <!-- Input Carousel -->
                <div class="col-md-4 mb-3">
                    <label for="uploadCarousel">Upload Carousel (Recommended .jpeg, .jpg, .png, .gif, .webp) <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" name="uploadCarousel" id="uploadCarousel" accept=".jpeg, .jpg, .png, .gif, .webp" required>
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-dark px-3 shadow-sm">SAVE</button>
            </div>
        </form>
    </div>



    {{-- ============= 2. Carousel table หน้า Carousel ============= --}}
    <div class="container shadow-sm rounded bg-light p-4 mt-4 mb-4">
        <p><span class="fw-bold">Carousel image table</span><br><span class="text-secondary">You can manages all carousel image in this table.</span></p>
        <table class="table table-striped table-hover css-serial" id="myTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Added By</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carousels as $all_carousel)
                    <tr>
                        <td></td>
                        <td>{{ $all_carousel->title }}</td>
                        <td>{{ $all_carousel->description }}</td>
                        <td><a href="{{ asset('storage/' . $all_carousel->image) }}" target="_blank">View</a></td>
                        <td>{{ $all_carousel->added_by }}</td>
                        <td>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $all_carousel->id }}"><i class="fas fa-edit"></i></button>
                                    <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $all_carousel->id }}"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        </td>
                    </tr>


                    <!-- Modal Edit Carousel -->
                    {{-- <div class="modal fade" id="editModal{{ $all_carousel->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-light" id="exampleModalLabel">Edit User's Account ?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('edit-carousel', $all_carousel->id) }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-0">
                                            <label for="editFirstname">Firstname <span class="text-danger"> *</span></label>
                                            <input type="text" class="form-control" name="editFirstname" id="editFirstname" value="{{ $all_users->firstname }}" placeholder="Firstname" required>
                                        </div>
                                        <div class="mb-0 mt-2">
                                            <label for="editLastname">Lastname <span class="text-danger"> *</span></label>
                                            <input type="text" class="form-control" name="editLastname" id="editLastname" value="{{ $all_users->lastname }}" placeholder="Lastname" required>
                                        </div>
                                        <div class="mb-0 mt-2">
                                            <label for="editPosition">Position <span class="text-danger"> *</span></label>
                                            <input type="text" class="form-control" name="editPosition" id="editPosition" value="{{ $all_users->position }}" placeholder="Position" required>
                                        </div>
                                        <div class="mb-0 mt-2">
                                            <label for="editEmail">Email</label>
                                            <input type="email" class="form-control" id="editEmail" aria-describedby="emailHelp" value="{{ $all_users->email }}" disabled>
                                            <small id="emailHelp" class="form-text text-muted">To change an email, Please logged in to this account to proceed.</small>
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


                    <!-- Modal Delete Carousel -->
                    <div class="modal fade" id="deleteModal{{ $all_carousel->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-danger">
                                    <h5 class="modal-title text-light" id="exampleModalLabel">Delete Carousel ?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Please confirm to delete this carousel ? <br><br>
                                    Title : {{ $all_carousel->title }} <br>
                                    Description : {{ $all_carousel->description }}
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('delete-users', $all_users->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> --}}
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