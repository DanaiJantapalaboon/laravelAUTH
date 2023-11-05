<?php

namespace App\Http\Controllers;

use App\Models\CompanyInfo;
use Illuminate\Http\Request;

class BaseController extends Controller
{

    //============= 1. ส่ง company name ไปแสดงใน footer จ้าา (ทำงานร่วมกับ AdminController) =============//
    protected function getCompanyName()
    {
        return CompanyInfo::select('name')->first()->name;
    }


    //============= 2. ส่ง company logo ไปแสดงใน navbar จ้าา (ทำงานร่วมกับ AdminController) =============//
    protected function getCompanyLogo()
    {
        return CompanyInfo::select('logo')->first()->logo;
    }


}