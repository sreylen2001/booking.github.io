<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Models\Bus;
use App\Models\Models\BusTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index(Request $request): View{
        $data['new_buses'] = DB::table('new_buses')->get();
        $data['new_bus_tickets'] = DB::table('new_bus_tickets')->where('status', '1')->paginate(5);
       
        return view('admins.user_tickets.index', $data);
        
    }

    public function create(){
        $data['new_buses'] = DB::table('new_buses')->get();
        $data['new_bus_tickets'] = DB::table('new_bus_tickets')->get();
        return view('admins.user_tickets.create', $data);
    }

    public function save(Request $request){

        $data['id'] = $request->id;
        $data['bus_id'] = $request->bus_id;
        $data['from'] = $request->from;
        $data['to'] = $request->to;
        $data['fare_amount'] = $request->fare_amount;
        $data['departure_time'] = $request->departure_time;
        $data['estimated_arrival_time'] = $request->estimated_arrival_time;

        $i = DB::table('new_bus_tickets')->insert($data);

        if($i){
            return redirect()->route('admin.user_ticket');
        }else{
            return redirect()->route('user_ticket.create');
        }
    }
    public function list_bus(Request $request){
        if ($request -> ajax()){
            return response(Bus::where('bus_id'))->$request->id->get();
        }
    }

    public function edit($id){
        $data['new_buses'] = DB::table('new_buses')->get();
        $data['new_bus_tickets'] = DB::table('new_bus_tickets')->find($id);
        return view('admins.user_tickets.edit', $data);
    }
    
    public function update(Request $request){
        $data['bus_id'] = $request->bus_id;
        $data['from'] = $request->from;
        $data['to'] = $request->to;
        $data['fare_amount'] = $request->fare_amount;
        $data['departure_time'] = $request->departure_time;
        $data['estimated_arrival_time'] = $request->estimated_arrival_time;
        $i = DB::table('new_bus_tickets')->where('id', $request->id)->update($data);
        if($i){
            session()->flash('message', ['success', 'Bus Ticket is updated successfully!']);
            return redirect()->route('admin.user_ticket');
        }else{
            session()->flash('message', ['error', 'Bus Ticket is updated Fail!']);
        }
    }

    public function delete($id){

        $affected = DB::table('new_bus_tickets')
        ->where('id', $id)
        ->update([
            'status' => '0'
        ]);
        if($affected){
            return redirect()->route('admin.user_ticket');
        }
    }
}
