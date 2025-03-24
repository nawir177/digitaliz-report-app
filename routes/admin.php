<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\DashboardController;

// set prefix admin and group middleware
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard',[DashboardController::class,'index'])->name('admin.dashboard');

    // report
    Route::get('/reports/{uuid}',[ReportController::class,'show'])->name('admin.report.show');
    Route::get('/reports/{uuid}/list',[ReportController::class,'listView'])->name('admin.report.list');
    Route::post('/reports/{uuid}/accept',[ReportController::class,'reportAccept'])->name('admin.report.accept');
    Route::post('/reports/{uuid}/reject',[ReportController::class,'reportReject'])->name('admin.report.reject');

    // employee
    Route::get('/employees',[EmployeeController::class,'index'])->name('admin.employee.index');
    Route::get('/employee/{id}/edit',[EmployeeController::class,'edit'])->name('admin.employee.edit');
    Route::put('/employee/{id}/update',[EmployeeController::class,'update'])->name('admin.employee.update');
    Route::post('/employee/store',[EmployeeController::class,'store'])->name('admin.employee.store');
    Route::delete('/employee/{id}/delete',[EmployeeController::class,'destroy'])->name('admin.employee.delete');
    
    // division
    Route::get('/divisions',[DivisionController::class,'index'])->name('admin.division.index');
    Route::post('/division/store',[DivisionController::class,'store'])->name('admin.division.store');
    Route::get('/division/{id}/edit',[DivisionController::class,'edit'])->name('admin.division.edit');
    Route::put('/division/{id}/update',[DivisionController::class,'update'])->name('admin.division.update');
    Route::delete('/division/{id}/delete',[DivisionController::class,'destroy'])->name('admin.division.delete');
    

});