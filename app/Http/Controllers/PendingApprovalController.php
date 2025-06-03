<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PendingApprovalController
{
    public function index()
    {
        return view('auth.pending-approval');
    }
}
