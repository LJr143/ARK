<?php

use App\Http\Controllers\Admin\MembershipApprovalController;
use App\Http\Controllers\Member\MemberManagement;
use App\Http\Controllers\View\ViewController;

/**
 * ADMIN ROUTES
 * TODO: CREATE ADMIN AUTHENTICATION ROUTE
 * TODO: CREATE MIDDLEWARE PROTECTION FOR ADMIN AND SUPERADMIN
 */



/**
 *  ADMIN PROTECTED ROUTES
 */
Route::middleware(['user.status','admin.auth'])->prefix('admin')->group(function () {
    Route::get('/members', [MemberManagement::class, 'index' ])->name('members.index');
    Route::get('/membership/pending', [MembershipApprovalController::class, 'pendingApplications'])->name('admin.membership.pending');
    Route::post('/membership/{id}/approve', [MembershipApprovalController::class, 'approveApplication'])->name('admin.membership.approve');
    Route::post('/membership/{id}/reject', [MembershipApprovalController::class, 'rejectApplication'])->name('admin.membership.reject');
    Route::get('/membership/payment', [ViewController::class, 'payment'])->name('admin.membership.payment');
    Route::get('/membership/transactions', [ViewController::class, 'transactions'])->name('admin.membership.transactions');
    Route::get('/settings/account-settings', [ViewController::class, 'accountSettings'])->name('admin.settings.account.settings');
    Route::get('/request/computational-request', [ViewController::class, 'computationalRequest'])->name('admin.request.computational.request');

});



