<?php

namespace App\Http\Controllers\NonAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('non_admin.dashboard.index');
    }
}
