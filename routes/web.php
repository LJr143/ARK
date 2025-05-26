<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\View\ViewController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/admin/routes.php';
require __DIR__.'/member/routes.php';

/**
 * Redirect / request to member.login route
 */
Route::get('login', function () {
    return redirect(route('member.login'));
});

Route::get('/login', fn () => redirect('/'))->name('login');


Route::get('login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::resource('reminders', ReminderController::class);
Route::get('/manage/reminder', [ViewController::class, 'ManageReminder'] )->name('manage.reminder');
