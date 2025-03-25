<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\DashboardController;

// set prefix admin and group middleware
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

    // report
    Route::get('/reports/{uuid}',[ReportController::class,'show'])->name('report.show');
    Route::get('/reports/{uuid}/list',[ReportController::class,'listView'])->name('report.list');
    Route::post('/reports/{uuid}/accept',[ReportController::class,'reportAccept'])->name('report.accept');
    Route::post('/reports/{uuid}/reject',[ReportController::class,'reportReject'])->name('report.reject');

    // employee
    Route::get('/employees',[EmployeeController::class,'index'])->name('employee.index');
    Route::get('/employee/{id}/edit',[EmployeeController::class,'edit'])->name('employee.edit');
    Route::put('/employee/{id}/update',[EmployeeController::class,'update'])->name('employee.update');
    Route::post('/employee/store',[EmployeeController::class,'store'])->name('employee.store');
    Route::delete('/employee/{id}/delete',[EmployeeController::class,'destroy'])->name('employee.delete');
    
    // division
    Route::get('/divisions',[DivisionController::class,'index'])->name('division.index');
    Route::post('/division/store',[DivisionController::class,'store'])->name('division.store');
    Route::get('/division/{id}/edit',[DivisionController::class,'edit'])->name('division.edit');
    Route::put('/division/{id}/update',[DivisionController::class,'update'])->name('division.update');
    Route::delete('/division/{id}/delete',[DivisionController::class,'destroy'])->name('division.delete');

    // project
    Route::resource('project', ProjectController::class);
    

});