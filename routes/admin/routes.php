<?php

use App\Http\Controllers\Admin\MembershipApprovalController;
use App\Http\Controllers\View\ViewController;

/**
 * ADMIN ROUTES
 * TODO: CREATE ADMIN AUTHENTICATION ROUTE
 * TODO: CREATE MIDDLEWARE PROTECTION FOR ADMIN AND SUPERADMIN
 */


/**
 *  ADMIN PROTECTED ROUTES
 */
Route::middleware(['admin.auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [ViewController::class, 'AdminDashboard'])->name('admin.dashboard');


});

Route::get('/membership/pending', [MembershipApprovalController::class, 'pendingApplications'])->name('admin.membership.pending');
Route::post('/membership/{id}/approve', [MembershipApprovalController::class, 'approveApplication'])->name('admin.membership.approve');
Route::post('/membership/{id}/reject', [MembershipApprovalController::class, 'rejectApplication'])->name('admin.membership.reject');
use Illuminate\Support\Facades\Mail;

Route::get('/test-mail', function () {
    Mail::raw('Test email from server.', function ($message) {
        $message->to('lorjohn143@gmail.com')
            ->subject('Server Mail Test');
    });
    return 'Email sent!';
});

