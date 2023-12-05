<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WebpageController;
use App\Http\Controllers\User_ProfileController;
use App\Http\Controllers\User_ManagementController;
use App\Http\Controllers\Company_ProfileController;
use App\Http\Controllers\Webpage_CarouselController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//============= 1. หมวด Authenticate =============//
//============= 1.1 forgot password =============//
Route::patch('/reset-password', [AuthController::class, 'resetPassword'])->name('reset-password');  // reset password modal
//============= 1.2 check ถ้าไม่มีการ login =============//
Route::group(['middleware' => 'guest'], function () {
    Route::get('/admin', [AuthController::class, 'login'])->name('login');                          // ถ้ามีการกรอก url/admin แล้วยังไม่ login
    Route::get('/auth/register', [AuthController::class, 'register'])->name('register');            // route มาที่หน้า register.blade.php
    Route::post('/auth/register', [AuthController::class, 'registerAccount'])->name('register');    // post ลงใน db
    Route::get('/auth/login', [AuthController::class, 'login'])->name('login');
    Route::post('/auth/login', [AuthController::class, 'authenticate'])->name('login');
});
//============= 1.3 check ถ้ามีการ login =============//
Route::group(['middleware' => 'auth'], function () {
    Route::get('/admin', [AdminController::class, 'home']);                                         // ถ้ามีการกรอก url/admin แต่ login แล้ว
    Route::get('/admin/home', [AdminController::class, 'home']);
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});
//============= 1.4 check login ถ้าถูกไปหน้า Home =============//
Route::get('/auth', function () {
    if (Auth::check()) {
        return redirect('/admin/home');
    }
    return view('auth/login');
});


//============= 2. หมวดหน้า Admin =============//
//============= 2.1 navbar link =============//
Route::get('/home', [AdminController::class, 'home'])->name('home');
Route::get('/web_carousel', [AdminController::class, 'web_carousel'])->name('web_carousel');
Route::get('/company_info', [AdminController::class, 'company_info'])->name('company_info');
Route::get('/user_profile', [AdminController::class, 'user_profile'])->name('user_profile');
Route::get('/user_management', [AdminController::class, 'user_management'])->name('user_management');
//============= หน้า My Profile =============//
Route::patch('/update-profile/{id}', [User_ProfileController::class, 'updateProfile'])->name('update-profile');
Route::patch('/update-email/{id}', [User_ProfileController::class, 'updateEmail'])->name('update-email');
Route::patch('/update-password{id}', [User_ProfileController::class, 'updatePassword'])->name('update-password');
Route::delete('/delete-account{id}', [User_ProfileController::class, 'deleteAccount'])->name('delete-account');




//============= หน้า carousel =============//
Route::post('/add-carousels', [Webpage_CarouselController::class, 'addCarousels'])->name('add-carousels');
Route::post('/edit-carousel/{id}', [Webpage_CarouselController::class, 'editCarousels'])->name('edit-carousel');
Route::delete('/delete-carousel/{id}', [Webpage_CarouselController::class, 'deleteCarousels'])->name('delete-carousel');


//============= หน้า user_management =============//
Route::post('/add-users', [User_ManagementController::class, 'addUsers'])->name('add-users');
Route::patch('/edit-users/{id}', [User_ManagementController::class, 'editUsers'])->name('edit-users');
Route::delete('/delete-users/{id}', [User_ManagementController::class, 'deleteUsers'])->name('delete-users');


//============= หน้า company_info =============//
Route::patch('/edit-company', [Company_ProfileController::class, 'editCompany'])->name('edit-company');
Route::patch('/upload-logo', [Company_ProfileController::class, 'uploadLogo'])->name('upload-logo');


//============= หน้าหลัก index =============//
Route::get('/', [WebpageController::class, 'index'])->name('index');