<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bus;
use App\Models\Destination;
use App\Models\Driver;
use App\Models\Region;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index(){
       
        $buses = Bus::where('status', '1')->get();
        $drivers = Driver::where('status', '1')->get();
        $regions = Region::where('status', '1')->get();
        $destinations = Destination::where('status', '1')->get();
        $schedules = Schedule::where('status', '1')->paginate(5);
        return view('admins.bus_schedules.bus_schedule_list', 
        compact('buses', 'regions', 'drivers', 'destinations', 'schedules'));
    }

    public function create(){
        $data['buses'] = DB::table('buses')->where('status', '1')->get();
        $data['drivers'] = DB::table('drivers')->where('status', '1')->get();
        $data['regions'] = DB::table('regions')->where('status', '1')->get();
        $data['destinations'] = DB::table('destinations')->where('status', '1')->get();
        $data['schedules'] = DB::table('schedules')->get();
        return view('admins.bus_schedules.add_bus_schedule', $data);
        //dd($data);
    }

    public function show_region(Request $request){
        if ($request -> ajax()){
            return response(Region::where('region_id'))->$request->id->get();
        }
    }

    public function show_bus(Request $request){
        if ($request -> ajax()){
            return response(Bus::where('bus_id'))->$request->id->get();
        }
    }

    public function show_driver(Request $request){
        if ($request -> ajax()){
            return response(Driver::where('driver_id'))->$request->id->get();
        }
    }

    public function show_destination(Request $request){
        if ($request -> ajax()){
            return response(Destination::where('destination_id'))->$request->id->get();
        }
    }

    public function save(Request $request){

        $data['id'] = $request->id;
        $data['user_id'] = Auth::user()->id;
        $data['bus_id'] = $request->bus_id;
        $data['driver_id'] = $request->driver_id;
        $data['region_id'] = $request->region_id;
        $data['destination_id'] = $request->destination_id;
        $data['schedule_date'] = $request->schedule_date;
        $data['departure_time'] = $request->departure_time;
        $data['estimated_arrival_time'] = $request->estimated_arrival_time;
        $data['fee'] = $request->fee;
        $data['remarks'] = $request->remarks;

        $i = DB::table('schedules')->insert($data);

        if($i){
            return redirect()->route('admin.bus_schedule');
        }else{
            return redirect()->route('admin_bus_schedule.create');
        }
    }

    public function edit($id){
        $data['buses'] = DB::table('buses')->where('status', '1')->get();
        $data['drivers'] = DB::table('drivers')->where('status', '1')->get();
        $data['regions'] = DB::table('regions')->where('status', '1')->get();
        $data['destinations'] = DB::table('destinations')->where('status', '1')->get();
        $data['schedules'] = DB::table('schedules')->find($id);
        return view('admins.bus_schedules.bus_schedule_edit', $data);
    }
    
    public function update(Request $request){
        $data['bus_id'] = $request->bus_id;
        $data['driver_id'] = $request->driver_id;
        $data['region_id'] = $request->region_id;
        $data['destination_id'] = $request->destination_id;
        $data['schedule_date'] = $request->schedule_date;
        $data['departure_time'] = $request->departure_time;
        $data['estimated_arrival_time'] = $request->estimated_arrival_time;
        $data['fee'] = $request->fee;
        $data['remarks'] = $request->remarks;

        $i = DB::table('schedules')->where('id', $request->id)->update($data);
        if($i){
            session()->flash('message', ['success', 'Schedule information is updated successfully!']);
            return redirect()->route('admin.bus_schedule');
        }else{
            session()->flash('message', ['error', 'Schedule information is updated Fail!']);
        }
    }

    public function delete($id){

        $affected = DB::table('schedules')
        ->where('id', $id)
        ->update([
            'status' => '0'
        ]);
        if($affected){
            return redirect()->route('admin.bus_schedule');
        }
    }
    
}
