<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin_URLController;
use App\Http\Controllers\Webpage_URLController;
use App\Http\Controllers\Admin_CarouselController;
use App\Http\Controllers\Admin_UserProfileController;
use App\Http\Controllers\Admin_CompanyInfoController;
use App\Http\Controllers\Admin_UserManagementController;


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


//================ 1. หมวด Authenticate ================//
//================ 1.1 forgot password ================//
Route::patch('/reset-password', [AuthController::class, 'resetPassword'])->name('reset-password');  // reset password modal
//================ 1.2 check ถ้าไม่มีการ login ================//
Route::group(['middleware' => 'guest'], function () {
    Route::get('/admin', [AuthController::class, 'login'])->name('login');                          // ถ้ามีการกรอก url/admin แล้วยังไม่ login
    Route::get('/auth/register', [AuthController::class, 'register'])->name('register');            // route มาที่หน้า register.blade.php
    Route::post('/auth/register', [AuthController::class, 'registerAccount'])->name('register');    // post ลงใน db
    Route::get('/auth/login', [AuthController::class, 'login'])->name('login');
    Route::post('/auth/login', [AuthController::class, 'authenticate'])->name('login');              // authenticate เข้าหน้า admin
});
//================ 1.3 check ถ้ามีการ login ================//
Route::group(['middleware' => 'auth'], function () {
    Route::get('/admin', [Admin_URLController::class, 'home']);                                      // ถ้ามีการกรอก url/admin แต่ login แล้ว
    Route::get('/admin/home', [Admin_UrlController::class, 'home']);
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});
//================ 1.4 check login ถ้าถูกไปหน้า Home ================//
Route::get('/auth', function () {
    if (Auth::check()) {
        return redirect('/admin/home');
    }
    return view('auth/login');
});


//============= 2. หมวดหน้า Admin =============//
//============= 2.1 navbar link =============//
Route::get('/admin/home', [Admin_URLController::class, 'home'])->name('home');
Route::get('/admin/web_carousel', [Admin_URLController::class, 'web_carousel'])->name('web_carousel');
Route::get('/admin/company_info', [Admin_URLController::class, 'company_info'])->name('company_info');
Route::get('/admin/user_profile', [Admin_URLController::class, 'user_profile'])->name('user_profile');
Route::get('/admin/user_management', [Admin_URLController::class, 'user_management'])->name('user_management');
//============= 2.2 หน้า carousel =============//
Route::post('/add-carousels', [Admin_CarouselController::class, 'addCarousels'])->name('add-carousels');
Route::patch('/edit-carousel/{id}', [Admin_CarouselController::class, 'editCarousels'])->name('edit-carousel');
Route::delete('/delete-carousel/{id}', [Admin_CarouselController::class, 'deleteCarousels'])->name('delete-carousel');
//============= 2.3 หน้า company_info =============//
Route::patch('/edit-company', [Admin_CompanyInfoController::class, 'editCompany'])->name('edit-company');
Route::patch('/upload-logo', [Admin_CompanyInfoController::class, 'uploadLogo'])->name('upload-logo');
//============= 2.4 หน้า user_management =============//
Route::post('/add-users', [Admin_UserManagementController::class, 'addUsers'])->name('add-users');
Route::patch('/edit-users/{id}', [Admin_UserManagementController::class, 'editUsers'])->name('edit-users');
Route::delete('/delete-users/{id}', [Admin_UserManagementController::class, 'deleteUsers'])->name('delete-users');
//============= 2.5 หน้า My Profile =============//
Route::patch('/update-profile/{id}', [Admin_UserProfileController::class, 'updateProfile'])->name('update-profile');
Route::patch('/update-email/{id}', [Admin_UserProfileController::class, 'updateEmail'])->name('update-email');
Route::patch('/update-password{id}', [Admin_UserProfileController::class, 'updatePassword'])->name('update-password');
Route::delete('/delete-account{id}', [Admin_UserProfileController::class, 'deleteAccount'])->name('delete-account');


//============= 3. หมวดหน้าหลัก index =============//
Route::get('/', [Webpage_URLController::class, 'index'])->name('index');