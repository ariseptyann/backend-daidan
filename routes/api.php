<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('employee')->group(function () {
    Route::post('list', [App\Http\Controllers\EmployeeController::class, 'index'])->name('api.employee.list');
    Route::get('status', [App\Http\Controllers\EmployeeController::class, 'statuses'])->name('api.employee.status');
});

Route::resource('employee', \App\Http\Controllers\EmployeeController::class);
Route::resource('company', \App\Http\Controllers\CompanyController::class);
Route::resource('departement', \App\Http\Controllers\DepartementController::class);
