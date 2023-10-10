<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyInfo;
use App\Models\User;

class AdminController extends Controller
{

    //============= 1. Link ส่งค่าไปหน้า home.blade.php =============//
    public function home()
    {
        $pageTitle = "Home";
        return view('admin/home', compact('pageTitle'));
    }


    //============= 2. Link ส่งค่าไปหน้า user_profile.blade.php =============//
    public function user_profile()
    {
        $pageTitle = "My Profile";
        return view('admin/user_profile', compact('pageTitle'));
    }


    //============= 3. Link ส่งค่าไปหน้า user_management.blade.php =============//
    public function user_management()
    {
        $pageTitle = "User Management";

        // ดึง Fetch ตารางจ้าา
        $data['users'] = User::orderBy('id', 'DESC')->get();
        return view('admin/user_management', compact('pageTitle'), $data);
    }


    //============= 4. Link ส่งค่าไปหน้า company_info.blade.php =============//
    public function company_info()
    {
        $pageTitle = "Company Information";
        $CompanyInfo = CompanyInfo::firstOrNew();
        return view('admin/company_info', compact('pageTitle', 'CompanyInfo'));
    }
}