<?php

use App\Http\Controllers\Backend\AjaxController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\DepositController;
use App\Http\Controllers\Backend\JobController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\WithdrawController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::resource('users', UserController::class)->except(['show']);

    Route::resource('categories', CategoryController::class)->except(['show']);

    Route::resource('jobs', JobController::class)->except(['edit', 'destroy']);

    Route::resource('deposits', DepositController::class)->only(['index', 'update', 'show']);

    Route::resource('withdraws', WithdrawController::class)->only(['index', 'update', 'show']);

    Route::get('profile', [ProfileController::class, 'profileView'])->name('profile.view');
    Route::put('profile/{id}', [ProfileController::class, 'profileUpdate'])->name('profile.update');

    Route::get('password', [ProfileController::class, 'passwordView'])->name('password.view');
    Route::put('password/{id}', [ProfileController::class, 'passwordUpdate'])->name('password.update');

    Route::get('settings', [SettingController::class, 'settingsView'])->name('settings.view');
    Route::post('settings', [SettingController::class, 'settingsUpdate'])->name('settings.update');

    //Report
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('proves', [ReportController::class, 'proveIndex'])->name('proves.index');
        Route::get('proves/{id}', [ReportController::class, 'proveShow'])->name('proves.show');
        Route::put('proves/{id}', [ReportController::class, 'proveUpdate'])->name('proves.update');

    });

    //Ajax Route
    Route::prefix('ajax')->name('ajax.')->group(function () {
        Route::post('jobs/approved', [AjaxController::class, 'jobApproved'])->name('jobs.approved');
    });
});

