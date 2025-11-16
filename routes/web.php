<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\controller;
use App\Http\Controllers\StudentController;

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/login',function(){
//     return view('login');
// });


// Route::get('/logi', [controller::class, 'home'])->name('home');

use App\Http\Controllers\MyPageController;
use App\Http\Controllers\classesController;
use App\Http\Controllers\AttendanceController;

Route::get('/', [StudentController::class, 'dashboard'])->name('dashboard');
Route::get('/classes',[classesController::class,'showClasses'])->name('classes');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/attendance', [App\Http\Controllers\AttendanceController::class, 'attendance'])->name('attendance');
Route::get('/students', [StudentController::class, 'students'])->name('students');
