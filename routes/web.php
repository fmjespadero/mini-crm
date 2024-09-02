<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::resource('companies', CompanyController::class);
    Route::resource('employees', EmployeeController::class);
});