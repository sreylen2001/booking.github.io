<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\Schedule;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookbusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $customers = Customer::where('status', '1')->get();
        $schedules = Schedule::where('status', '1')->get();
        $booking_cars = Booking::where('status', '1')->paginate(5);
        return view('admins.admin_books.index', compact('customers', 'schedules', 'booking_cars'));
    }

    public function create(){
        $data['customers'] = DB::table('customers')->where('status', '1')->get();
        $data['schedules'] = DB::table('schedules')->where('status', '1')->get();
        $data['booking_cars'] = DB::table('booking_cars')->get();

        return view('admins.admin_books.create', $data);
    }

    public function list_customer(Request $request){
        if ($request -> ajax()){
            return response(Customer::where('schedule_id'))->$request->id->get();
        }
    }

    public function list_schedule(Request $request){
        if ($request -> ajax()){
            return response(Schedule::where('customer_id'))->$request->id->get();
        }
    }

    public function save(Request $request){
        $data['id'] = $request->id;
        $data['user_id'] = Auth::user()->id;
        $data['schedule_id'] = $request->schedule_id;
        $data['customer_id'] = $request->customer_id;
        $data['number_of_seats'] = $request->number_of_seats;
        $data['fare_amount'] = $request->fare_amount;
        $data['total_amount'] = $request->total_amount;

        $i = DB::table('booking_cars')->insert($data);

        if($i){
            return redirect()->route('admin.admin_bookbus');
        }else{
            return redirect()->route('admin_bookbus.create');
        }
    }

    public function edit($id){
        $data['customers'] = DB::table('customers')->where('status', '1')->get();
        $data['schedules'] = DB::table('schedules')->where('status', '1')->get();
        $data['booking_cars'] = DB::table('booking_cars')->find($id);

        return view('admins.admin_books.edit', $data);
    }

    public function update(Request $request){
        $data['schedule_id'] = $request->schedule_id;
        $data['customer_id'] = $request->customer_id;
        $data['number_of_seats'] = $request->number_of_seats;
        $data['fare_amount'] = $request->fare_amount;
        $data['total_amount'] = $request->total_amount;

        $i = DB::table('booking_cars')->where('id', $request->id)->update($data);
        if($i){
            session()->flash('message', ['success', 'Booking information is updated successfully!']);
            return redirect()->route('admin.admin_bookbus');
        }else{
            session()->flash('message', ['error', 'Booking information is updated Fail!']);
        }
    }

    public function delete($id){

        $affected = DB::table('booking_cars')
        ->where('id', $id)
        ->update([
            'status' => '0'
        ]);
        if($affected){
            return redirect()->route('admin.admin_bookbus');
        }
    }

}
