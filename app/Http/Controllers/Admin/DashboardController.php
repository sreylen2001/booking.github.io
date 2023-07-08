<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function dashboard()
    {
        $data['new_roles'] = DB::table('new_roles')->count();
        $data['new_users'] = DB::table('new_users')->count();
        $data['new_bookings'] = DB::table('new_bookings')->count();
        
        return view('admins.dashboard', $data);
    }
}
