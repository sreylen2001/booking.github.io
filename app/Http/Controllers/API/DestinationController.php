<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DestinationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $destinations = Destination::where('status', '1')->paginate(5);
        return view('admins.sub_regions.destination_list', compact('destinations'));
    }

    public function create(){
        $data['destinations'] = DB::table('destinations')->get();
        return view('admins.sub_regions.add_destination', $data);
    }
 
    public function save(Request $request){

        $this->destination_validation($request);

        $destination_name = $request->get('destination_name');

        $insertDestination = [
            'destination_name' => $destination_name,
        ];
        //dd($insertRegion);
        $i = DB::table('destinations')->insert($insertDestination);

        if($i){
            Session::flash('msg', 'Region Register Successfully!');
            return redirect()->route('admin.admin_destination');
        }else{
            return redirect()->route('admin_destination.create');
        }
    }

    public function destination_validation(Request $request){
        $rules = [
            
            'destination_name' => 'required'
        ];
    }

    public function edit($id){
        $data['destinations'] = DB::table('destinations')->find($id);
        return view('admins.sub_regions.destination_edit', $data);
    }
    
    public function update(Request $request){
        $data['destination_name'] = $request->destination_name;

        $i = DB::table('destinations')->where('id', $request->id)->update($data);
        if($i){
            session()->flash('message', ['success', 'Destination information is updated successfully!']);
            return redirect()->route('admin.admin_destination');
        }else{
            session()->flash('message', ['error', 'Destination information is updated Fail!']);
        }
    }

    public function delete($id){

        $affected = DB::table('destinations')
        ->where('id', $id)
        ->update([
            'status' => '0'
        ]);
        if($affected){
            return redirect()->route('admin.admin_destination');
        }
    }
}
