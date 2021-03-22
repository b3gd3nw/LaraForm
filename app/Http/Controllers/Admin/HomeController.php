<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $members_count = Member::all()->count();
        return view('admin.home.home', [
            'members_count' => $members_count
        ]);
    }
}
