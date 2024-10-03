<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BloodPocketController;
use App\Http\Controllers\CustumersController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->name('admin.')->middleware('auth')->group(function(){
    Route::resource('blood',BloodPocketController::class);
});

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function(){
    Route::resource('hopital',HospitalController::class);
});

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function(){
    Route::resource('user',UserController::class);
});


Route::middleware('auth')->group(function(){
    Route::get('admin',[AdminController::class, 'index'])->name('admin.');
    Route::get('/superadmin',[AdminController::class,'superadminvisual'])->name('admin.superadmin');
    
    Route::get('/profile',[ProfileController::class,'displayprofile'])->name('admin.profile');
    Route::put('/profile/update',[ProfileController::class,'upadateprofile'])->name('admin.profile.update');
    
    Route::get('/transactions/pdf',[AdminController::class,'transactionsToPdf'])->name('transactions/pdf');
    Route::get('/transactions/export-pdf',[AdminController::class,'exportTransactionsToPdf'])->name('transactions/export-pdf');

    Route::get('/admin/consommation',[AdminController::class,'consommation'])->name('admin.consommation');
    Route::get('/admin/consommation-search',[AdminController::class,'searchconsommation'])->name('admin.consommation-search');
});


Route::get('/',[CustumersController::class,'index']);
Route::resource('/customer',CustumersController::class)->except('index');

Route::get('/research',[CustumersController::class,'research'])->name('research');
Route::get('/search',[CustumersController::class,'search'])->name('search');

require __DIR__.'/auth.php';
