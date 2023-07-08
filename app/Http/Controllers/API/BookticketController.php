<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Models\Bus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Models\User;




class BookticketController extends Controller
{
    public function index(){

        $data['new_buses'] = DB::table('new_buses')->get();
        $data['new_bookings'] = DB::table('new_bookings')->paginate(5);
        return view('admins.user_bookings.index', $data);
        
    }

    public function create(){
        $data['new_buses'] = DB::table('new_buses')->get();
        $data['new_bus_tickets'] = DB::table('new_bus_tickets')->get();

        $data['new_bookings'] = DB::table('new_bookings')->get();
        return view('admins.user_bookings.create', $data);
    }

    public function save(Request $request){

        $select = DB::table('new_bus_tickets')
        ->select('fare_amount')->get();

        //dd($select);

        $data['id'] = $request->id;
        $data['user_id'] = auth()->id();
        $data['bus_id'] = $request->bus_id;
        $data['number_of_seats'] = $request->number_of_seats;
        $number = $data['number_of_seats'];
        $data['total_amount'] = $number * $select;
        
        $data['status'] = 1;
        $i = DB::table('new_bookings')->insert($data);

        if($i){
            return redirect()->route('admin.user_booking');
        }else{
            return redirect()->route('user_booking.create');
        }
    }
}
