<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
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


Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/dashboard', [ViewController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-as-read');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
    Route::post('/notifications/clear', [NotificationController::class, 'clearAll'])->name('notifications.clear');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::resource('reminders', ReminderController::class);
    Route::get('/manage/reminder/{reminder}', [ViewController::class, 'ManageReminder'])->name('manage.reminder');
    Route::get('/attachments/{attachment}/download', [ReminderController::class, 'downloadAttachment'])->name('attachments.download');
    Route::get('/payment', function () {
        return view('payment.payment');
    })->name('payment');

    Route::get('/paypal/success', function (Request $request) {
        $orderId = session('paypal_order_id');
        $userId = session('paypal_user_id');

        if (!$orderId) {
            return redirect()->route('payment')->with('error', 'Payment session expired');
        }

        $paypalService = new PayPalService();
        $result = $paypalService->captureOrder($orderId, $userId);

        if ($result['success']) {
            // Clear session
            session()->forget(['paypal_transaction_id', 'paypal_order_id', 'paypal_user_id']);

            return view('payment.payment-success', [
                'payment' => $result['payment'],
                'transaction' => $result['transaction'],
                'paypal_result' => $result['paypal_result']
            ]);
        } else {
            return redirect()->route('payment')->with('error', $result['message']);
        }
    })->name('paypal.success');

    Route::get('/paypal/cancel', function () {
        // Update transaction status to cancelled if needed
        $transactionId = session('paypal_transaction_id');
        if ($transactionId) {
            Transaction::where('id', $transactionId)->update(['status' => 'cancelled']);
        }

        session()->forget(['paypal_transaction_id', 'paypal_order_id', 'paypal_user_id']);

        return redirect()->route('payment')->with('error', 'Payment was cancelled');
    })->name('paypal.cancel');

});


