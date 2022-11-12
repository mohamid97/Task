<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Users\LoginController;
use App\Http\Controllers\Users\SignController;
use App\Http\Controllers\Users\UploadFileController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/' , [HomeController::class , 'index'])->name('home');
Route::get('/home' , [HomeController::class , 'index'])->name('home');
// start login controller
Route::get('/login' , [LoginController::class , 'login'])->name('login');
Route::post('/check-login' , [LoginController::class , 'check_login'])->name('check-login');


// start signup Controller
Route::get('/signup' , [SignController::class , 'index'])->name('register');
Route::post('/register' , [SignController::class , 'register'])->name('check-register');


Route::group(['middleware' => 'auth'], function () {
    Route::resource('upload-files' , UploadFileController::class);
});
// start Upload File Controller

