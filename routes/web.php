<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\controller;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\loginController as LoginCheck;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\classesController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\dashboardController;


//Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
Route::get('/classes',[classesController::class,'showClasses'])->name('classes');
Auth::routes();
Route::post('/login/check',[LoginCheck::class,'checkLogin'])->name('check.login');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
Route::get('/index', [dashboardController::class, 'index'])->name('index');
Route::get('/attendance', [App\Http\Controllers\AttendanceController::class, 'attendance'])->name('attendance');
Route::get('/students', [StudentController::class, 'students'])->name('students');
Route::get('/' , [LoginController::class, 'login'])->name('login');
