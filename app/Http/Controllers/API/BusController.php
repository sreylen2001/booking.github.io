<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){

        $data['buses'] = DB::table('buses')->where('status', '1')->paginate(5);
        return view('admins.admin_buses.index', $data);
        
    }
    public function create(){
        $data['buses'] = DB::table('buses')->get();
        return view('admins.admin_buses.create', $data);
    }

    public function save(Request $request){

        $data['id'] = $request->id;
        $data['user_id'] = Auth::user()->id;
        $data['bus_number'] = $request->bus_number;
        $data['bus_plate_number'] = $request->bus_plate_number;
        $data['bus_type'] = $request->bus_type;
        $data['capacity'] = $request->capacity;

        $i = DB::table('buses')->insert($data);

        if($i){
            return redirect()->route('admin.admin_bus');
        }else{
            return redirect()->route('admin_bus.create');
        }
    }

    public function edit($id){
        $data['buses'] = DB::table('buses')->find($id);
        return view('admins.admin_buses.edit', $data);
    }
    
    public function update(Request $request){
        $data['bus_number'] = $request->bus_number;
        $data['bus_plate_number'] = $request->bus_plate_number;
        $data['bus_type'] = $request->bus_type;
        $data['capacity'] = $request->capacity;

        $i = DB::table('buses')->where('id', $request->id)->update($data);
        if($i){
            session()->flash('message', ['success', 'Bus information is updated successfully!']);
            return redirect()->route('admin.admin_bus');
        }else{
            session()->flash('message', ['error', 'Bus information is updated Fail!']);
        }
    }

    public function delete($id){

        $affected = DB::table('buses')
        ->where('id', $id)
        ->update([
            'status' => '0'
        ]);
        if($affected){
            return redirect()->route('admin.admin_bus');
        }
    }

}
