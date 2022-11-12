<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\UploadsController;


Route::group(['prefix' => 'dashboard' , 'middleware'=>'is_admin'], function(){
    Route::get('/' , [DashboardController::class , 'index'])->name('dashboard');
// start resource users controller for crud operations
    Route::resource('users' , UsersController::class)->except('show');
//start uploads controller
    Route::get('add-files/user' , [UploadsController::class , 'create'])->name('admin-add-files');
    Route::post('store-files/user' , [UploadsController::class , 'store'])->name('admin-store-files');
    Route::get('delete-files/user/{id}' , [UploadsController::class , 'delete'])->name('admin-delete-files');

});


