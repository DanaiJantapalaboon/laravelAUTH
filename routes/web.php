<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\User_ProfileController;
use App\Http\Controllers\User_ManagementController;
use App\Http\Controllers\CompanyController;


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

//============= Homepage หน้าแรก =============//
Route::get('/', function () {
    return view('welcome');
});


//============= check ถ้าไม่มีการ login =============//
Route::group(['middleware' => 'guest'], function () {
    Route::get('/auth/register', [AuthController::class, 'register'])->name('register');            // route มาที่หน้า register.blade.php
    Route::post('/auth/register', [AuthController::class, 'registerAccount'])->name('register');    // post ลงใน db
    Route::get('/auth/login', [AuthController::class, 'login'])->name('login');
    Route::post('/auth/login', [AuthController::class, 'authenticate'])->name('login');
});


//============= check ถ้ามีการ login =============//
Route::group(['middleware' => 'auth'], function () {
    Route::get('/admin/home', [AdminController::class, 'home']);
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});


//============= check login ถ้าถูกไปหน้า Home =============//
Route::get('/auth', function () {
    if (Auth::check()) {
        return redirect('/admin/home');
    }
    return view('auth/login');
});


//============= edit Profile =============//
Route::post('/update-profile/{id}', [User_ProfileController::class, 'updateProfile'])->name('update-profile');


//============= edit Password =============//
Route::post('/update-password{id}', [User_ProfileController::class, 'updatePassword'])->name('update-password');


//============= delete Account =============//
Route::post('/delete-account{id}', [User_ProfileController::class, 'deleteAccount'])->name('delete-account');


//============= reset-password =============//
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset-password');


//============= navbar link =============//
Route::get('/home', [AdminController::class, 'home'])->name('home');
Route::get('/company_info', [AdminController::class, 'company_info'])->name('company_info');
Route::get('/user_profile', [AdminController::class, 'user_profile'])->name('user_profile');
Route::get('/user_management', [AdminController::class, 'user_management'])->name('user_management');


//============= หน้า user_management =============//
Route::post('/add-users', [User_ManagementController::class, 'addUsers'])->name('add-users');
Route::post('/edit-users/{id}', [User_ManagementController::class, 'editUsers'])->name('edit-users');
Route::delete('/delete-users/{id}', [User_ManagementController::class, 'deleteUsers'])->name('delete-users');


//============= หน้า company_info =============//
Route::post('/edit-company', [CompanyController::class, 'editCompany'])->name('edit-company');
Route::post('/upload-logo', [CompanyController::class, 'uploadLogo'])->name('upload-logo');