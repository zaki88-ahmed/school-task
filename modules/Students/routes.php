<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use modules\Customers\Controllers\CustomerController;
use modules\Students\Controllers\StudentController;


//Route::get('customers',  [CustomerController::class, 'allCustomers']);
//Route::post('/test',  [AdminController::class, 'test']);
Route::middleware('auth:sanctum')->group(function () {

    Route::post('students/create',  [StudentController::class, 'createStudent']);
//    Route::post('students/update-password',  [StudentController::class, 'updatePassword']);
    Route::get('students',  [StudentController::class, 'allStudents']);
    Route::get('students/show',  [StudentController::class, 'studentDetails']);
    Route::post('students/edit',  [StudentController::class, 'updateStudent']);
    Route::post('students/delete',  [StudentController::class, 'softDeleteStudent']);
    Route::post('students/restore',  [StudentController::class, 'restoreStudent']);
    Route::get('students/order',  [StudentController::class, 'orderStudents']);
});
//
//Route::post('customers/register',  [CustomerController::class, 'register']);
//Route::post('customers/login',  [CustomerController::class, 'login']);
//Route::post('customers/logout',  [CustomerController::class, 'logout']);
//
//
//Route::get('customers/register/verify/{id}',  [CustomerController::class, 'verify'])->name('verify.mail');

//Auth::routes(['verify' => true]);




