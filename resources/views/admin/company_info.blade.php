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
    <div class="container shadow-sm rounded bg-light p-4 mt-4 mb-4">
        <p><span class="fw-bold">Edit Your Company Information</span><br><span class="text-secondary">To update your company information please proceed the setup, The information will be used to display on company webpage.</span></p>
        <form action="{{ route('edit-company') }}" method="POST">
            @csrf
            <div class="row">
                <!-- Company Name -->
                <div class="col-md-8 mb-2">
                    <label for="companyname">Company name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="companyname" id="companyname" value="{{ $CompanyInfo->name }}" placeholder="..." required>
                </div>

                <!-- Company Email -->
                <div class="col-md-4 mb-2">
                    <label for="companyemail">Company Email / Business Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="companyemail" id="companyemail" value="{{ $CompanyInfo->email }}" placeholder="..." required>
                </div>
            </div>
            <div class="row">
                <!-- Company Address -->
                <div class="col-md-8 mb-2">
                    <label for="companyaddress">Address <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="companyaddress" id="companyaddress" value="{{ $CompanyInfo->address }}" placeholder="..." required>
                </div>

                <!-- Company TaxID -->
                <div class="col-md-4 mb-2">
                    <label for="companytaxid">Tax ID <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="companytaxid" id="companytaxid" maxlength="13" value="{{ $CompanyInfo->taxid }}" placeholder="..." required>
                </div>
            </div>
            <div class="row">
                <!-- About Company -->
                <div class="col-md-12 mb-2">
                    <label for="companyabout">About Company <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="companyabout" id="companyabout" rows="4" placeholder="..." required>{{ $CompanyInfo->about }}</textarea>
                </div>
            </div>
            <div class="row">
                <!-- Company Phone1 -->
                <div class="col-md-4 mb-3">
                    <label for="companyphone1">Phone 1 <span class="text-danger">*</span></label>
                    <input type="tel" class="form-control" name="companyphone1" id="companyphone1" maxlength="10" value="{{ $CompanyInfo->tel_1 }}" placeholder="..." required>
                </div>

                <!-- Company Phone2 (optional) -->
                <div class="col-md-4 mb-3">
                    <label for="companyphone2">Phone 2 (Optional)</label>
                    <input type="tel" class="form-control" name="companyphone2" id="companyphone2" maxlength="10" value="{{ $CompanyInfo->tel_2 }}" placeholder="...">
                </div>

                <!-- Company fax (optional) -->
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



    {{-- ============= <script></script> tag below code ============= --}}
    @include('admin.includes.scripttag_below')

    {{-- ============= Footer Copyright ============= --}}
    @include('admin.includes.footer')


</body>
</html>