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


//============================= 1. หมวด Authenticate =============================//
//============================= 1.1 forgot password =============================//
Route::patch('/reset-password', [AuthController::class, 'resetPassword'])->name('reset-password');  // reset password modal
//============================= 1.2 check ถ้าไม่มีการ login =============================//
Route::controller(AuthController::class)->group(function () {
    Route::get('/admin', 'login')->name('login');                          // ถ้ามีการกรอก url/admin แล้วยังไม่ login
    Route::get('/auth/register', 'register')->name('register');            // route มาที่หน้า register.blade.php
    Route::post('/auth/register', 'registerAccount')->name('register');    // post ลงใน db
    Route::get('/auth/login', 'login')->name('login');
    Route::post('/auth/login', 'authenticate')->name('login');              // authenticate เข้าหน้า admin
});
//============================= 1.3 check ถ้ามีการ login =============================//
Route::group(['middleware' => 'auth'], function () {
    Route::get('/admin', [Admin_URLController::class, 'home']);                                      // ถ้ามีการกรอก url/admin แต่ login แล้ว
    Route::get('/admin/home', [Admin_UrlController::class, 'home']);
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});
//============================= 1.4 check login ถ้าถูกไปหน้า Home =============================//
Route::get('/auth', function () {
    if (Auth::check()) {
        return redirect('/admin/home');
    }
    return view('auth/login');
});



//============================= 2. หมวดหน้า Admin =============================//
//============================= 2.1 navbar link =============================//
Route::controller(Admin_URLController::class)->group(function () {
    Route::get('/admin/home', 'home')->name('home');
    Route::get('/admin/web_carousel', 'web_carousel')->name('web_carousel');
    Route::get('/admin/company_info', 'company_info')->name('company_info');
    Route::get('/admin/user_profile', 'user_profile')->name('user_profile');
    Route::get('/admin/user_management', 'user_management')->name('user_management');
});
//============================= 2.2 หน้า carousel =============================//
Route::controller(Admin_CarouselController::class)->group(function () {
    Route::post('/add-carousels', 'addCarousels')->name('add-carousels');
    Route::patch('/edit-carousel/{id}', 'editCarousels')->name('edit-carousel');
    Route::delete('/delete-carousel/{id}', 'deleteCarousels')->name('delete-carousel');
});
//============================= 2.3 หน้า company_info =============================//
Route::controller(Admin_CompanyInfoController::class)->group(function () {
    Route::patch('/edit-company', 'editCompany')->name('edit-company');
    Route::patch('/upload-logo', 'uploadLogo')->name('upload-logo');
});
//============================= 2.4 หน้า user_management =============================//
Route::controller(Admin_UserManagementController::class)->group(function () {
    Route::post('/add-users', 'addUsers')->name('add-users');
    Route::patch('/edit-users/{id}', 'editUsers')->name('edit-users');
    Route::delete('/delete-users/{id}', 'deleteUsers')->name('delete-users');
});
//============================= 2.5 หน้า My Profile =============================//
Route::controller(Admin_UserProfileController::class)->group(function () {
    Route::patch('/update-profile/{id}', 'updateProfile')->name('update-profile');
    Route::patch('/update-email/{id}', 'updateEmail')->name('update-email');
    Route::patch('/update-password{id}', 'updatePassword')->name('update-password');
    Route::delete('/delete-account{id}', 'deleteAccount')->name('delete-account');
});



//============================= 3. หมวดหน้าหลัก index =============================//
Route::get('/', [Webpage_URLController::class, 'index'])->name('index');