<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use modules\Admins\Controllers\AdminController;


Route::middleware('auth:sanctum')->group(function () {


    Route::post('admin/logout',  [AdminController::class, 'logout'])->name('admin.logout');
    Route::post('admin/index',  [AdminController::class, 'index']);
});

Route::post('/admin/login',  [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/register',  [AdminController::class, 'register']);

