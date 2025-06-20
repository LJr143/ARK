<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PendingApprovalController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\View\ViewController;
use Illuminate\Http\Client\Request;
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
Route::get('/registration/success', function () {
    return view('ark.admin.auth.success');
})->name('member.registration.success');


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
    Route::get('/membership/dues', [ViewController::class, 'membershipDues'])->name('membership-fee.dues');

    Route::get('/paypal/success', [PaymentController::class, 'success'])->name('paypal.success');
    Route::get('/paypal/cancel', [PaymentController::class, 'cancel'])->name('paypal.cancel');
    Route::get('/settings/account-settings', [ViewController::class, 'accountSettings'])->name('admin.settings.account.settings');

    Route::get('/receipt/download/{filename}', function ($filename) {
        try {
            // Ensure the filename has the proper path and extension
            $filePath = "receipts/{$filename}.pdf";

            if (!Storage::exists($filePath)) {
                Log::error('Receipt file not found for download', [
                    'requested_filename' => $filename,
                    'full_path' => $filePath,
                    'storage_path' => Storage::path($filePath)
                ]);
                abort(404, 'Receipt not found');
            }

            Log::info('Downloading receipt', ['filename' => $filename, 'path' => $filePath]);

            return Storage::download($filePath, $filename . '.pdf');

        } catch (\Exception $e) {
            Log::error('Error downloading receipt', [
                'filename' => $filename,
                'error' => $e->getMessage()
            ]);
            abort(500, 'Error downloading receipt');
        }
    })->name('receipt.download');

    Route::get('/receipt/view/{filename}', function ($filename) {
        try {
            // Ensure the filename has the proper path and extension
            $filePath = "receipts/{$filename}.pdf";

            if (!Storage::exists($filePath)) {
                Log::error('Receipt file not found for viewing', [
                    'requested_filename' => $filename,
                    'full_path' => $filePath,
                    'storage_path' => Storage::path($filePath)
                ]);
                abort(404, 'Receipt not found');
            }

            Log::info('Viewing receipt', ['filename' => $filename, 'path' => $filePath]);

            $fullPath = Storage::path($filePath);

            return response()->file($fullPath, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $filename . '.pdf"'
            ]);

        } catch (\Exception $e) {
            Log::error('Error viewing receipt', [
                'filename' => $filename,
                'error' => $e->getMessage()
            ]);
            abort(500, 'Error viewing receipt');
        }
    })->name('receipt.view');

});

Route::post('/test-broadcast-auth', function (Request $request) {
    return response()->json([
        'session' => $request->session()->all(),
        'user' => auth()->user() ? auth()->user()->id : null,
        'headers' => $request->headers->all(),
    ]);
});
