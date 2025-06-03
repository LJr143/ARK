<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PendingApprovalController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\View\ViewController;
use App\Models\Transaction;
use App\Services\PayPalService;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/admin/routes.php';
require __DIR__ . '/member/routes.php';

/**
 * Redirect / request to member.login route
 */
Route::get('login', function () {
    return redirect(route('member.login'));
});

Route::get('/login', fn() => redirect('/'))->name('login');
Route::get('login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [LoginController::class, 'handleGoogleCallback']);
Route::get('/pending-approval', [PendingApprovalController::class, 'index'])
    ->name('pending-approval');


Route::middleware(['auth:sanctum', 'user.status'])->group(function () {

    Route::get('/dashboard', [ViewController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/notifications/details', [ViewController::class, 'notifications'])->name('notifications.details.index');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-as-read');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
    Route::post('/notifications/clear', [NotificationController::class, 'clearAll'])->name('notifications.clear');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::resource('reminders', ReminderController::class);
    Route::get('/manage/reminder/{reminder}', [ViewController::class, 'ManageReminder'])->name('manage.reminder');
    Route::get('/attachments/{attachment}/download', [ReminderController::class, 'downloadAttachment'])->name('attachments.download');
    Route::get('/request/request-history', [ViewController::class, 'requestHistory'])->name('request.history');
    Route::get('/membership/dues',[ViewController::class, 'membershipDues'])->name('membership-fee.dues');

    Route::get('/paypal/success', [PaymentController::class, 'success'])->name('paypal.success');
    Route::get('/paypal/cancel', [PaymentController::class, 'cancel'])->name('paypal.cancel');

});

