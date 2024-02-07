<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{{ $pageTitle }}</title>
        @include('admin.dependency.cdn')
    </head>
<body class="admin-bg">

    @include('admin.includes.navbar')

    
    <div class="container-fluid shadow-sm border-top bg-light">
        <div class="container">
            <h5 class="fw-bold py-3">{{ $pageTitle }}</h5>
        </div>
    </div>


    {{-- ============= 1. Update Company Info ============= --}}
    <div class="container shadow-sm rounded bg-light p-4 mt-4 mb-4">
        <p><span class="fw-bold">Edit Your Company Information</span><br><span class="text-secondary">To update your company information please proceed the setup, The information will be used to display on company webpage.</span></p>
        <form action="{{ route('edit-company') }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-md-8 mb-2">
                    <label for="companyname">Company name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="companyname" id="companyname" maxlength="100" value="{{ $CompanyInfo->name }}" placeholder="..." required>
                </div>

                <div class="col-md-4 mb-2">
                    <label for="companyemail">Company Email / Business Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="companyemail" id="companyemail" maxlength="100" value="{{ $CompanyInfo->email }}" placeholder="..." required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 mb-2">
                    <label for="companyaddress">Address <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="companyaddress" id="companyaddress" maxlength="255" value="{{ $CompanyInfo->address }}" placeholder="..." required>
                </div>

                <div class="col-md-4 mb-2">
                    <label for="companytaxid">Tax ID <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="companytaxid" id="companytaxid" maxlength="13" value="{{ $CompanyInfo->taxid }}" placeholder="..." required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-2">
                    <label for="companyabout">About Company <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="companyabout" id="companyabout" rows="4" placeholder="..." required>{{ $CompanyInfo->about }}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="companyphone1">Phone 1 <span class="text-danger">*</span></label>
                    <input type="tel" class="form-control" name="companyphone1" id="companyphone1" maxlength="10" value="{{ $CompanyInfo->tel_1 }}" placeholder="..." required>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="companyphone2">Phone 2 (Optional)</label>
                    <input type="tel" class="form-control" name="companyphone2" id="companyphone2" maxlength="10" value="{{ $CompanyInfo->tel_2 }}" placeholder="...">
                </div>

                <div class="col-md-4 mb-3">
                    <label for="companyfax">Fax (Optional)</label>
                    <input type="tel" class="form-control" name="companyfax" id="companyfax" maxlength="10" value="{{ $CompanyInfo->fax }}" placeholder="...">
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-dark px-3 shadow-sm">SAVE</button>
            </div>
        </form>
    </div>


    {{-- ============= 2. Upload Company Logo ============= --}}
    <div class="container shadow-sm rounded bg-light p-4 mt-4 mb-4">
        <p><span class="fw-bold">Upload Your Company Logo</span><br><span class="text-secondary">To update or upload your new company logo, The logo will show on all pages of your website.</span></p>
        <form action="{{ route('upload-logo') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-md-4 mb-3">
                    <input type="file" class="form-control" name="uploadLogo" accept=".jpeg, .jpg, .png, .gif" required>
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-dark px-3 shadow-sm">SAVE</button>
            </div>
        </form>
    </div>

    @include('admin.includes.pagescript')
    @include('admin.includes.footer')

</body>
</html>