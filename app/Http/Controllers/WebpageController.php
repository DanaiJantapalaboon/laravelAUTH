<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebpageController extends BaseController
{

    //============= 1. ไปหน้า index =============//
    public function index()
    {
        $pageTitle = "Home";
        $companyName = $this->getCompanyName();
        $companyLogo = $this->getCompanyLogo();

        return view('index', compact('pageTitle', 'companyName', 'companyLogo'));
    }
}
