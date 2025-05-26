<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Member\MembershipController;
use App\Http\Controllers\View\ViewController;
use Illuminate\Support\Facades\Route;

/**
 * Member Authentication Routes
 */
Route::group(['middleware' => ['check.superadmin','redirect.auth']], function () {
    Route::get('/', [LoginController::class, 'login'])->name('member.login');
    Route::post('/', [LoginController::class, 'authenticate'])->name('member.login.post')->middleware('throttle:5,1');
});

/**
 * Member Protected Routes
 * TODO: CREATE MIDDLEWARE FOR MEMBER AUTHENTICATION AND PROTECTION
 */

Route::middleware(['member.auth'])->prefix('member')->group(function () {
    Route::get('/dashboard', [ViewController::class, 'MemberDashboard'])->name('member.dashboard');
});

Route::get('/membership-registration/{step?}', [MembershipController::class, 'showForm'])->name('membership.form');
Route::post('/membership/save/{step}', [MembershipController::class, 'saveStep'])->name('membership.save-step');



