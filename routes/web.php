<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PendingApprovalController;
use App\Http\Controllers\ReceiptController;
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
Route::get('/pending-approval', [PendingApprovalController::class, 'index'])->name('pending-approval');
Route::get('/registration/success', function () {return view('ark.admin.auth.success');})->name('member.registration.success');



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
    Route::get('/settings/account-settings', [ViewController::class, 'accountSettings'])->name('admin.settings.account.settings');


    // View receipt in HTML format (for screenshots)
    Route::get('/receipt/{payment}/show', [ReceiptController::class, 'show'])->name('receipt.show');

    // Download receipt as PDF
    Route::get('/receipt/{payment}/download', [ReceiptController::class, 'download'])->name('receipt.download');

    // View receipt as PDF in browser
    Route::get('/receipt/{payment}/view', [ReceiptController::class, 'view'])->name('receipt.view');

    // Get receipt by transaction reference
    Route::get('/receipt/transaction/{transactionReference}', [ReceiptController::class, 'showByTransaction'])->name('receipt.show.transaction');

    // Download receipt by transaction reference
    Route::get('/receipt/transaction/{transactionReference}/download', [ReceiptController::class, 'downloadByTransaction'])->name('receipt.download.transaction');

    // Get receipt summary (for AJAX)
    Route::get('/receipt/{payment}/summary', [ReceiptController::class, 'summary'])->name('receipt.summary');

    // List user receipts
    Route::get('/receipts', [ReceiptController::class, 'userReceipts'])->name('receipts.index');
    Route::get('/receipts/user/{user}', [ReceiptController::class, 'userReceipts'])->name('receipts.user');

    // Bulk download receipts
    Route::post('/receipts/bulk-download', [ReceiptController::class, 'bulkDownload'])->name('receipts.bulk.download');

    // Email receipt
    Route::post('/receipt/{payment}/email', [ReceiptController::class, 'email'])->name('receipt.email');

});

Route::get('/public/receipt/{payment}/{token?}', [ReceiptController::class, 'show'])->name('receipt.public.show');
Route::get('/public/receipt/{payment}/download/{token?}', [ReceiptController::class, 'download'])->name('receipt.public.download');

