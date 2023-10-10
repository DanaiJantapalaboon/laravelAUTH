<?php

namespace App\Http\Controllers;

use App\Models\CompanyInfo;
use Illuminate\Http\Request;

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
}
