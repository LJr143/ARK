<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MemberManagement extends  Controller
{
 public function index(Request $request){
     return view('ark.admin.member.index');
 }
}
