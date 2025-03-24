<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ListReportController;
use App\Http\Controllers\ProjectHasReportController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard',[ReportController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // report
    Route::resource('report',ReportController::class);
    // project has reprot
    Route::post('project-has-reprot/store',[ProjectHasReportController::class,'store'])->name('projectHasReport.store');
    Route::get('generate-pdf/{uuid}', [ProjectHasReportController::class, 'generatePDF'])->name('generatePdf');
    Route::get('project-has-report-edit/{uuid}', [ProjectHasReportController::class, 'edit'])->name('projectHasReport.edit');
    Route::patch('project-has-report-update/{uuid}', [ProjectHasReportController::class, 'update'])->name('projectHasReport.update');
    Route::get('project-has-report/{uuid}', [ProjectHasReportController::class, 'downloadPDF'])->name('projectHasReport.downloadPdf');
    ROute::delete('project-has-report-delete/{uuid}', [ProjectHasReportController::class, 'destroy'])->name('projectHasReport.delete');

    // report list
    Route::get('list-report/{uuid}',[ListReportController::class,'listView'])->name('projectHasReport.list');
    Route::post('list-report-store',[ListReportController::class,'storeList'])->name('projectHasReport.storeList');
    Route::delete('list-report-delete/{uuid}', [ListReportController::class, 'deleteList'])->name('projectHasReprot.deleteList');
    Route::get('list-report-edit/{uuid}', [ListReportController::class, 'editList'])->name('projectHasReprot.editList');
    Route::patch('list-report-update/{uuid}',[ListReportController::class, 'updateList'])->name('projectHasReprot.updateList');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
