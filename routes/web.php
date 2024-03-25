<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\MyJobController;
use App\Http\Controllers\ProveController;
use App\Http\Controllers\ProveNoteController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\WithdrawController;
use App\Http\Controllers\WorkController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', HomeController::class)->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('jobs', [JobController::class, 'index'])->name('jobs');
    Route::get('job/{id}', [JobController::class, 'show'])->name('jobs.show');
    Route::resource('deposits', DepositController::class)->only(['index', 'create', 'store']);
    Route::resource('withdraws', WithdrawController::class)->only(['index', 'create', 'store']);

    //Work Route
    Route::get('my-works', [WorkController::class, 'index'])->name('works.index');
    Route::post('my-works', [WorkController::class, 'store'])->name('works.store');
    Route::get('my-works/{id}', [WorkController::class, 'show'])->name('works.show');

    //Job
    Route::resource('my-jobs', MyJobController::class)->except(['edit', 'destroy']);
    Route::resource('my-jobs.proves', ProveController::class)->only(['index', 'update', 'show']);
    Route::post('proves/notes', [ProveNoteController::class, 'store'])->name('proves.notes.store');
    Route::post('proves/{id}', [ProveController::class, 'approvedAll'])->name('proves.approve.all');

    //
    Route::get('profile', [ProfileController::class, 'profileView'])->name('profile.view');
    Route::put('profile/{id}', [ProfileController::class, 'profileUpdate'])->name('profile.update');
    Route::get('password', [ProfileController::class, 'passwordView'])->name('password.view');
    Route::put('password/{id}', [ProfileController::class, 'passwordChange'])->name('password.change');

    //
    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');

    Route::get('balance', [BalanceController::class, 'index'])->name('balance.index');

    //Report
    Route::post('reports/proves/{id}',[ReportController::class,'proveStore'])->name('reports.proves.store');

});


//Ajax Route
Route::prefix('ajax')->name('ajax.')->group(function () {
    Route::post('category/', [AjaxController::class, 'getCategory'])->name('category');
});

