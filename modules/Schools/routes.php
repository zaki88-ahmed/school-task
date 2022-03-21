<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use modules\Customers\Controllers\CustomerController;
use modules\Schools\Controllers\SchoolController;


//Route::get('customers',  [CustomerController::class, 'allCustomers']);
//Route::post('/test',  [AdminController::class, 'test']);
Route::middleware('auth:sanctum')->group(function () {

    Route::post('schools/create',  [SchoolController::class, 'createSchool']);
    Route::get('schools',  [SchoolController::class, 'allSchools']);
    Route::get('schools/show',  [SchoolController::class, 'schoolDetails']);
    Route::post('schools/edit',  [SchoolController::class, 'updateSchool']);
    Route::post('schools/delete',  [SchoolController::class, 'softDeleteSchool']);
    Route::post('schools/restore',  [SchoolController::class, 'restoreSchool']);
});

//Auth::routes(['verify' => true]);




