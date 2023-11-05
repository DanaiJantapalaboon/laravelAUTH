<?php

namespace App\Http\Controllers;

use App\Models\CompanyInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function editCompany(Request $request) {

        $request->validate([
            'companyname' => 'required|string',
            'companyemail' => 'required|email',
            'companyaddress' => 'required|string',
            'companytaxid' => 'required|string|max:13',
            'companyabout' => 'required|string',
            'companyphone1' => 'required|string',
            'companyphone2' => 'nullable|string',
            'companyfax' => 'nullable|string'
        ]);

        // Retrieve the existing CompanyInfo or create a new one if it doesn't exist
        $CompanyInfo = CompanyInfo::firstOrNew();

        $CompanyInfo->name = $request->input('companyname');
        $CompanyInfo->email = $request->input('companyemail');
        $CompanyInfo->address = $request->input('companyaddress');
        $CompanyInfo->taxid = $request->input('companytaxid');
        $CompanyInfo->about = $request->input('companyabout');
        $CompanyInfo->tel_1 = $request->input('companyphone1');
        $CompanyInfo->tel_2 = $request->input('companyphone2');
        $CompanyInfo->fax = $request->input('companyfax');
        $CompanyInfo->save();

        return back();
    }


    public function uploadLogo(Request $request) {

        $request->validate([
            'uploadLogo' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024',
        ]);

        $path = $request->file('uploadLogo')->store('uploaded_file/logo');

        // Update the first row in the 'companyinfo' table with the new logo path
        $company = CompanyInfo::first();

        // ถ้ามี logo อยู่แล้วให้ลบออกแล้ว update ใหม่
        if ($company->logo) {
            Storage::disk()->delete($company->logo);
        }

        $company->update(['logo' => $path]);

        return back();
    }
}