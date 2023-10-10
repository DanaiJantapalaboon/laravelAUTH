<?php

namespace App\Http\Controllers;

use App\Models\CompanyInfo;
use Illuminate\Http\Request;

class BaseController extends Controller
{

    //============= ส่ง company name ไปแสดงใน footer จ้าา =============//
    protected function getCompanyName()
    {
        return CompanyInfo::select('name')->first()->name;
    }
}
