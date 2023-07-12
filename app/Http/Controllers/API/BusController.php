<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Models\Booking;
use App\Models\Models\Bus;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Models\User;

class BusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $data['new_users'] = DB::table('new_users')
        ->where('name')
        ->orWhere('role_id', '3')
        ->get()->toArray();
        //dd($se);
        $data['new_users'] = DB::table('new_users')->get()->toArray();
        $data['new_buses'] = DB::table('new_buses')->paginate(5);
        //$MergeArray = $se->merge($data);
        //$MergeArray = array_merge($isConnectedM,$isConnectedA);
        return view('admins.admin_buses.index',$data);

    }

    public function create(){
        $data['new_users'] = DB::table('new_users')
        ->where('name')
        ->orWhere('role_id', '3')
        ->get()->toArray();
        $data['new_users'] = DB::table('new_users')->get()->toArray();
        $data['new_buses'] = DB::table('new_buses')->get();
        return view('admins.admin_buses.create', $data);
    }

    public function save(Request $request){

        $data['id'] = $request->id;
        $data['user_id'] = $request->user_id;
        $data['plate_number'] = $request->plate_number;
        $data['bus_type'] = $request->bus_type;
        $data['capacity'] = $request->capacity;
        $data['book_seat'] = $request->book_seat;
        $data['status'] = $request->status;
        $i = DB::table('new_buses')->insert($data);

        if($i){
            return redirect()->route('admin.admin_bus');
        }else{
            return redirect()->route('admin_bus.create');
        }
    }

    public function show_user(Request $request){
        if ($request -> ajax()){
            return response(User::where('user_id'))
            ->orwhere('name')
            ->orWhere('role_id', '3')
            ->$request->id->get()->toArray();
        }
    }

    public function edit($id){
        $data['new_buses'] = DB::table('new_buses')->find($id);
        return view('admins.admin_buses.edit', $data);
    }

    public function update(Request $request){
        $data['plate_number'] = $request->plate_number;
        $data['bus_type'] = $request->bus_type;
        $data['capacity'] = $request->capacity;
        $data['book_seat'] = $request->book_seat;
        //$data['bus_status'] = $request->bus_status;
        $i = DB::table('new_buses')->where('id', $request->id)->update($data);
        if($i){
            session()->flash('message', ['success', 'Bus information is updated successfully!']);
            return redirect()->route('admin.admin_bus');
        }else{
            session()->flash('message', ['error', 'Bus information is updated Fail!']);
        }
    }

    public function delete($id){

        $affected = DB::table('new_buses')
        ->where('id', $id)
        ->update([
            'status' => '0'
        ]);
        if($affected){
            return redirect()->route('admin.admin_bus');
        }
    }



}
