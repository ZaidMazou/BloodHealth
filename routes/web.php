<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BloodPocketController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->get('admin',[AdminController::class, 'index'])->name('admin.');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function(){
    Route::resource('blood',BloodPocketController::class);
});

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function(){
    Route::resource('hopital',HospitalController::class);
});

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function(){
    Route::resource('user',UserController::class);
});

Route::middleware('auth')->get('/superadmin',[AdminController::class,'superadminvisual'])->name('admin.superadmin');
require __DIR__.'/auth.php';
