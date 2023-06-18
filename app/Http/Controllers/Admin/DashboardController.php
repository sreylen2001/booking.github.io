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
        $data['customers'] = DB::table('customers')->count();
        $data['booking_cars'] = DB::table('booking_cars')->count();
        
        return view('admins.dashboard', $data);
    }
}
