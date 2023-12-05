<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\Http\Request;

class Webpage_URLController extends BaseController
{

    //============= 1. ไปหน้า index =============//
    public function index()
    {
        $pageTitle = "Home";
        $companyName = $this->getCompanyName();
        $companyLogo = $this->getCompanyLogo();

        // fetch all ไปแสดง carousel
        $carousel = Carousel::all();
        return view('index', compact('pageTitle', 'companyName', 'companyLogo', 'carousel'));
    }
}
